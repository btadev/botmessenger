<?php

namespace ChienIT\BotMessenger\Interfaces;

use ChienIT\BotMessenger\BotMessenger;

interface ExceptionHandlerInterface
{
    /**
     * Handle an exception.
     *
     * @param \Throwable $e
     * @param IncomingMessage $matchingMessage
