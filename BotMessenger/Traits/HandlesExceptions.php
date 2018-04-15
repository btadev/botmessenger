<?php

namespace ChienIT\BotMessenger\Traits;

use ChienIT\BotMessenger\Interfaces\ExceptionHandlerInterface;

trait HandlesExceptions
{
    /**
     * Register a custom exception handler.
     *
     * @param string $exception
     * @param callable $closure
     */
    public function exception(string $exception, $closure)
    {
        $this->exceptionHandler->register($exception, $this->getCallable($closure));
    }

