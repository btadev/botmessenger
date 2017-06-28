<?php

namespace ChienIT\BotMessenger\Interfaces\Middleware;

use ChienIT\BotMessenger\BotMessenger;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

interface Captured
{
    /**
     * Handle a captured message.
     *
     * @param IncomingMessage $message
     * @param callable $next
     * @param BotMessenger $bot
     *
     * @return mixed
     */
    public function captured(IncomingMessage $message, $next, BotMessenger $bot);
}
