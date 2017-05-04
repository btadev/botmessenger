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
    }
