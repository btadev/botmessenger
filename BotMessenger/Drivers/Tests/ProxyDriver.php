<?php

/*
 * This file is part of ChienIt Bot Messenger.
 *
 * (c) Nguyen Duc Chien <chiendevit@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace ChienIT\BotMessenger\Drivers\Tests;

use ChienIT\BotMessenger\Http\Curl;
use ChienIT\BotMessenger\Drivers\NullDriver;
use ChienIT\BotMessenger\Interfaces\DriverInterface;
use Symfony\Component\HttpFoundation\Request;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

/**
 * A driver that acts as a proxy for a global driver instance. Useful for mock/fake drivers in integration tests.
 */
final class ProxyDriver implements DriverInterface
{
    /**
     * @var DriverInterface
     */
    private static $instance;

    /**
     * Set driver instance to be used.
     *
     * @param DriverInterface $driver
     */
    public static function setInstance(DriverInterface $driver)
    {
        self::$instance = $driver;
    }

    /**
     * @return DriverInterface
     */
    private static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new NullDriver(new Request, [], new Curl);
        }

        return self::$instance;
    }

    public function matchesRequest()
    {
        return self::instance()->matchesRequest();
    }

    public function hasMatchingEvent()
    {
        return self::instance()->hasMatchingEvent();
    }

    public function getMessages()
    {
        return self::instance()->getMessages();
    }

    public function isBot()
    {
        return self::instance()->isBot();
    }

    public function isConfigured()
    {
        return self::instance()->isConfigured();
    }

    public function getUser(IncomingMessage $matchingMessage)
    {
        return self::instance()->getUser($matchingMessage);
    }

    public function getConversationAnswer(IncomingMessage $message)
    {
        return self::instance()->getConversationAnswer($message);
    }

    public function buildServicePayload($message, $matchingMessage, $additionalParameters = [])
    {
        return self::instance()->buildServicePayload($message, $matchingMessage, $additionalParameters);
    }

    public function sendPayload($payload)
    {
        return self::instance()->sendPayload($payload);
    }

    public function getName()
    {
        return self::instance()->getName();
    }

    public function types(IncomingMessage $matchingMessage)
    {
        return self::instance()->types($matchingMessage);
    }

    /**
     * Tells if the stored conversation callbacks are serialized.
     *
     * @return bool
     */
    public function serializesCallbacks()
    {
        return self::instance()->serializesCallbacks();
    }
}
