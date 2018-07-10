<?php

namespace ChienIT\BotMessenger\Interfaces;

use ChienIT\BotMessenger\BotMessenger;

interface ExceptionHandlerInterface
{
    /**
     * Handle an exception.
     *
     * @param \Throwable $e
     * @param BotMessenger $bot
     * @return mixed
     */
    public function handleException($e, BotMessenger $bot);

    /**
     * Register a new exception type.
     *
     * @param string $exception
     * @param callable $closure
     * @return mixed
            'next' => $this->prepareCallbacks($next),
