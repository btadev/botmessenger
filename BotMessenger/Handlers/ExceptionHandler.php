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
     * @param BotMessenger $bot
     * @return mixed
     * @throws \Throwable
     */
    public function handleException($e, BotMessenger $bot)
    {
        $class = get_class($e);
        $handler = $this->exceptions->get($class);

