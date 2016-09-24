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
