<?php

/*
 * This file is part of ChienIt Bot Messenger.
 *
 * (c) Nguyen Duc Chien <chiendevit@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace ChienIT\BotMessenger\Middleware;

use ChienIT\BotMessenger\BotMessenger;
use ChienIT\BotMessenger\Interfaces\HttpInterface;
use ChienIT\BotMessenger\Interfaces\MiddlewareInterface;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

class MsgSmart implements MiddlewareInterface
{
    /**
     * MsgSmart constructor.
     */
    public function __construct()
    {
    }

    /**
     * Handle a captured message.
     *
     * @param \ChienIT\BotMessenger\Messages\Incoming\IncomingMessage $message
     * @param BotMessenger $bot
     * @param $next
     *
     * @return mixed
     */
    public function captured(IncomingMessage $message, $next, BotMessenger $bot)
    {
        return $next($message);
    }

    /**
     * Handle an incoming message.
     *
     * @param IncomingMessage $message
     * @param BotMessenger $bot
     * @param $next
     *
     * @return mixed
     */
    public function received(IncomingMessage $message, $next, BotMessenger $bot)
    {
        return $next($message);
    }

    /**
     * @param \ChienIT\BotMessenger\Messages\Incoming\IncomingMessage $message
     * @param string $pattern
     * @param bool $regexMatched Indicator if the regular expression was matched too
     * @return bool
     */
    public function matching(IncomingMessage $message, $pattern, $regexMatched)
    {
        return true;
    }

    /**
     * Handle a message that was successfully heard, but not processed yet.
     *
     * @param \ChienIT\BotMessenger\Messages\Incoming\IncomingMessage $message
     * @param BotMessenger $bot
     * @param $next
     *
     * @return mixed
     */
    public function heard(IncomingMessage $message, $next, BotMessenger $bot)
    {
        return $next($message);
    }

    /**
     * Handle an outgoing message payload before/after it
     * hits the message service.
     *
     * @param mixed $payload
     * @param BotMessenger $bot
     * @param $next
     *
     * @return mixed
     */
    public function sending($payload, $next, BotMessenger $bot)
    {
        return $next($payload);
    }
}
