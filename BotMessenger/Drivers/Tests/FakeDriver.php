<?php

namespace ChienIT\BotMessenger\Drivers\Tests;

use ChienIT\BotMessenger\Users\User;
use ChienIT\BotMessenger\Messages\Incoming\Answer;
use ChienIT\BotMessenger\Interfaces\DriverInterface;
use ChienIT\BotMessenger\Interfaces\VerifiesService;
use ChienIT\BotMessenger\Messages\Outgoing\Question;
use Symfony\Component\HttpFoundation\Request;
use ChienIT\BotMessenger\Drivers\Events\GenericEvent;
use Symfony\Component\HttpFoundation\Response;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

/**
 * A fake driver for tests. Must be used with ProxyDriver.
 * Example to set it up in a unit test:
 * <code>
 *  public static function setUpBeforeClass()
 *  {
 *      DriverManager::loadDriver(ProxyDriver::class);
 *  }
 *  public function setUp()
 *  {
 *      $this->fakeDriver = new FakeDriver();
 *      ProxyDriver::setInstance($this->fakeDriver);
 *  }
 * </code>.
 */
class FakeDriver implements DriverInterface, VerifiesService
{
    /** @var bool */
    public $matchesRequest = true;

    /** @var bool */
    public $hasMatchingEvent = false;

    /** @var \ChienIT\BotMessenger\Messages\Incoming\IncomingMessage[] */
    public $messages = [];

    /** @var bool */
    public $isBot = false;

    /** @var bool */
    public $isInteractiveMessageReply = false;

    /** @var bool */
    public $isConfigured = true;

    /** @var array */
    private $botMessages = [];

    /** @var bool */
    private $botIsTyping = false;

    /** @var string */
    private $driver_name = 'Fake';

    /** @var string */
    private $event_name;

    /** @var array */
    private $event_payload;

    /** @var string */
    private $user_id = null;

    /** @var string */
    private $user_first_name = 'Marcel';

    /** @var string */
    private $user_last_name = 'Pociot';

    /** @var string */
    private $username = 'BotMessenger';

    /** @var array */
    private $user_info = [];

    /**
     * @return FakeDriver
     */
    public static function create()
    {
        return new static;
    }

    /**
     * @return FakeDriver
     */
    public static function createInactive()
    {
        $driver = new static;
        $driver->isConfigured = false;

        return $driver;
    }

    public function matchesRequest()
    {
        return $this->matchesRequest;
    }

    public function getMessages()
    {
        foreach ($this->messages as &$message) {
            $message->setIsFromBot($this->isBot());
        }

        return $this->messages;
    }

    protected function isBot()
    {
        return $this->isBot;
    }

    public function isConfigured()
    {
        return $this->isConfigured;
    }

    public function setUser(array $user_info)
    {
        $this->user_id = $user_info['id'] ?? $this->user_id;
        $this->user_first_name = $user_info['first_name'] ?? $this->user_first_name;
        $this->user_last_name = $user_info['last_name'] ?? $this->user_last_name;
        $this->username = $user_info['username'] ?? $this->username;
        $this->user_info = $user_info;
    }

    public function getUser(IncomingMessage $matchingMessage)
    {
        return new User($this->user_id ?? $matchingMessage->getSender(), $this->user_first_name, $this->user_last_name, $this->username, $this->user_info);
    }

    public function getConversationAnswer(IncomingMessage $message)
    {
        $answer = Answer::create($message->getText())->setMessage($message)->setValue($message->getText());
        $answer->setInteractiveReply($this->isInteractiveMessageReply);

        return $answer;
    }

    public function buildServicePayload($message, $matchingMessage, $additionalParameters = [])
    {
        return $message;
    }

    public function sendPayload($payload)
    {
        $this->botMessages[] = $payload;
        $text = method_exists($payload, 'getText') ? $payload->getText() : '';
