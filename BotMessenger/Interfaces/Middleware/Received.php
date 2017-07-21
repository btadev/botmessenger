<?php

namespace ChienIT\BotMessenger\Interfaces\Middleware;

use ChienIT\BotMessenger\BotMessenger;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

interface Received
{
    /**
     * Handle an incoming message.
     *
     * @param IncomingMessage $message
     * @param callable $next
     * @param BotMessenger $bot
    public function matchesRequest()
