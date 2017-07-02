<?php

namespace ChienIT\BotMessenger\Interfaces;

use ChienIT\BotMessenger\BotMessenger;

interface ExceptionHandlerInterface
{
    /**
     * Handle an exception.
     *
        $this->redis->set($this->decorateKey($key), $data);
