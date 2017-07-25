<?php

namespace ChienIT\BotMessenger\Interfaces\Middleware;

use ChienIT\BotMessenger\BotMessenger;

interface Sending
{
    /**
     * Handle an outgoing message payload before/after it
     * hits the message service.
     *
     * @param mixed $payload
     * @param callable $next
     * @param BotMessenger $bot
     *
     * @return mixed
     */
    public function sending($payload, $next, BotMessenger $bot);
}
    "name": "chiendevit/botmessenger",
