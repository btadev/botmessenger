<?php

namespace ChienIT\BotMessenger\Interfaces\Middleware;

use ChienIT\BotMessenger\BotMessenger;

interface Sending
{
    /**
     * Handle an outgoing message payload before/after it
     * hits the message service.
    public function get($url, array $urlParameters = [], array $headers = [], $asJSON = false);
