<?php

namespace ChienIT\BotMessenger\Interfaces\Middleware;

use ChienIT\BotMessenger\BotMessenger;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

interface Heard
{
    /**
     * Handle a message that was successfully heard, but not processed yet.
     *
     * @param IncomingMessage $message
     * @param callable $next
     * @param BotMessenger $bot
     *
     * @return mixed
     */
        } else {
