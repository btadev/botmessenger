<?php

namespace ChienIT\BotMessenger;

use Closure;
use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Commands\Command;
use ChienIT\BotMessenger\Messages\Matcher;
use Psr\Container\ContainerInterface;
use ChienIT\BotMessenger\Drivers\DriverManager;
use ChienIT\BotMessenger\Traits\ProvidesStorage;
use ChienIT\BotMessenger\Interfaces\UserInterface;
use ChienIT\BotMessenger\Messages\Incoming\Answer;
use ChienIT\BotMessenger\Traits\HandlesExceptions;
use ChienIT\BotMessenger\Handlers\ExceptionHandler;
use ChienIT\BotMessenger\Interfaces\CacheInterface;
use ChienIT\BotMessenger\Messages\Attachments\File;
use ChienIT\BotMessenger\Interfaces\DriverInterface;
use ChienIT\BotMessenger\Messages\Attachments\Audio;
use ChienIT\BotMessenger\Messages\Attachments\Image;
use ChienIT\BotMessenger\Messages\Attachments\Video;
use ChienIT\BotMessenger\Messages\Outgoing\Question;
use Psr\Container\NotFoundExceptionInterface;
use ChienIT\BotMessenger\Interfaces\Middleware\Heard;
use ChienIT\BotMessenger\Interfaces\StorageInterface;
use ChienIT\BotMessenger\Traits\HandlesConversations;
use Symfony\Component\HttpFoundation\Response;
use ChienIT\BotMessenger\Commands\ConversationManager;
use ChienIT\BotMessenger\Middleware\MiddlewareManager;
use ChienIT\BotMessenger\Messages\Attachments\Location;
use ChienIT\BotMessenger\Exceptions\Base\BotMessengerException;
use ChienIT\BotMessenger\Interfaces\DriverEventInterface;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;
use ChienIT\BotMessenger\Messages\Outgoing\OutgoingMessage;
use ChienIT\BotMessenger\Interfaces\ExceptionHandlerInterface;
use ChienIT\BotMessenger\Exceptions\Core\BadMethodCallException;
use ChienIT\BotMessenger\Exceptions\Core\UnexpectedValueException;
use ChienIT\BotMessenger\Messages\Conversations\InlineConversation;

/**
 * Class BotMessenger.
 */
class BotMessenger
{
    use ProvidesStorage,
        HandlesConversations,
        HandlesExceptions;

    /** @var \Illuminate\Support\Collection */
    protected $event;

    /** @var Command */
    protected $command;

    /** @var IncomingMessage */
    protected $message;

    /** @var OutgoingMessage|Question */
    protected $outgoingMessage;

    /** @var string */
    protected $driverName;

    /** @var array|null */
    protected $currentConversationData;

    /** @var ExceptionHandlerInterface */
    protected $exceptionHandler;

    /**
     * IncomingMessage service events.
     * @var array
     */
    protected $events = [];

    /**
     * The fallback message to use, if no match
     * could be heard.
     * @var callable|null
     */
    protected $fallbackMessage;

    /** @var array */
    protected $groupAttributes = [];

    /** @var array */
    protected $matches = [];

    /** @var DriverInterface */
    protected $driver;

    /** @var array */
    protected $config = [];

    /** @var MiddlewareManager */
    public $middleware;

    /** @var ConversationManager */
    protected $conversationManager;

    /** @var CacheInterface */
    private $cache;

    /** @var ContainerInterface */
    protected $container;

    /** @var StorageInterface */
    protected $storage;

    /** @var Matcher */
    protected $matcher;

    /** @var bool */
    protected $loadedConversation = false;

    /** @var bool */
    protected $firedDriverEvents = false;

    /** @var bool */
    protected $runsOnSocket = false;

    /**
     * BotMessenger constructor.
     * @param CacheInterface $cache
     * @param DriverInterface $driver
     * @param array $config
     * @param StorageInterface $storage
     */
    public function __construct(CacheInterface $cache, DriverInterface $driver, $config, StorageInterface $storage)
    {
        $this->cache = $cache;
        $this->message = new IncomingMessage('', '', '');
        $this->driver = $driver;
        $this->config = $config;
        $this->storage = $storage;
        $this->matcher = new Matcher();
        $this->middleware = new MiddlewareManager($this);
        $this->conversationManager = new ConversationManager();
        $this->exceptionHandler = new ExceptionHandler();
    }

    /**
     * Set a fallback message to use if no listener matches.
     *
     * @param callable $callback
     */
    public function fallback($callback)
    {
        $this->fallbackMessage = $callback;
    }

    /**
     * @param string $name The Driver name or class
     */
    public function loadDriver($name)
    {
        $this->driver = DriverManager::loadFromName($name, $this->config);
    }

    /**
     * @param DriverInterface $driver
     */
    public function setDriver(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @return DriverInterface
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Retrieve the chat message.
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->getDriver()->getMessages();
    }

    /**
     * Retrieve the chat message that are sent from bots.
     *
     * @return array
     */
    public function getBotMessages()
    {
        return Collection::make($this->getDriver()->getMessages())->filter(function (IncomingMessage $message) {
            return $message->isFromBot();
        })->toArray();
    }

    /**
     * @return Answer
     */
    public function getConversationAnswer()
    {
        return $this->getDriver()->getConversationAnswer($this->message);
    }

    /**
     * @param bool $running
     * @return bool
     */
    public function runsOnSocket($running = null)
    {
        if (is_bool($running)) {
            $this->runsOnSocket = $running;
        }

        return $this->runsOnSocket;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        if ($user = $this->cache->get('user_'.$this->driver->getName().'_'.$this->getMessage()->getSender())) {
            return $user;
        }

        $user = $this->getDriver()->getUser($this->getMessage());
        $this->cache->put('user_'.$this->driver->getName().'_'.$user->getId(), $user, $this->config['user_cache_time'] ?? 30);

        return $user;
    }

    /**
     * Get the parameter names for the route.
     *
     * @param $value
     * @return array
     */
    protected function compileParameterNames($value)
    {
        preg_match_all(Matcher::PARAM_NAME_REGEX, $value, $matches);

        return array_map(function ($m) {
            return trim($m, '?');
        }, $matches[1]);
    }

    /**
     * @param string $pattern the pattern to listen for
     * @param Closure|string $callback the callback to execute. Either a closure or a Class@method notation
     * @param string $in the channel type to listen to (either direct message or public channel)
     * @return Command
     */
    public function hears($pattern, $callback, $in = null)
    {
        $command = new Command($pattern, $callback, $in);
        $command->applyGroupAttributes($this->groupAttributes);

        $this->conversationManager->listenTo($command);

        return $command;
    }

    /**
     * Listen for messaging service events.
     *
     * @param string $name
     * @param Closure|string $callback
     */
    public function on($name, $callback)
    {
        $this->events[] = [
            'name' => $name,
            'callback' => $this->getCallable($callback),
        ];
    }

    /**
     * Listening for image files.
     *
     * @param $callback
     * @return Command
     */
    public function receivesImages($callback)
    {
        return $this->hears(Image::PATTERN, $callback);
    }

    /**
     * Listening for image files.
     *
     * @param $callback
     * @return Command
     */
    public function receivesVideos($callback)
    {
        return $this->hears(Video::PATTERN, $callback);
    }

    /**
     * Listening for audio files.
     *
     * @param $callback
     * @return Command
     */
    public function receivesAudio($callback)
    {
        return $this->hears(Audio::PATTERN, $callback);
    }

    /**
     * Listening for location attachment.
     *
     * @param $callback
     * @return Command
     */
    public function receivesLocation($callback)
    {
        return $this->hears(Location::PATTERN, $callback);
    }

    /**
     * Listening for files attachment.
     *
     * @param $callback
     * @return Command
     */
    public function receivesFiles($callback)
    {
        return $this->hears(File::PATTERN, $callback);
    }

    /**
     * Create a command group with shared attributes.
     *
     * @param  array $attributes
     * @param  \Closure $callback
     */
    public function group(array $attributes, Closure $callback)
    {
        $previousGroupAttributes = $this->groupAttributes;
    /**
