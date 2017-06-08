<?php

namespace ChienIT\BotMessenger\Handlers;

use ChienIT\BotMessenger\BotMessenger;
use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Interfaces\ExceptionHandlerInterface;

class ExceptionHandler implements ExceptionHandlerInterface
{
    protected $exceptions = [];

    public function __construct()
    {
        $this->exceptions = Collection::make();
    }

    /**
     * Handle an exception.
     *
     * @param  \Throwable $e
