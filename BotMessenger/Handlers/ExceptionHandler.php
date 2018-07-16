<?php

/*
 * This file is part of ChienIt Bot Messenger.
 *
 * (c) Nguyen Duc Chien <chiendevit@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
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

        // Exact exception handler found, call it.
        if ($handler !== null) {
            call_user_func_array($handler, [$e, $bot]);

            return;
        }

        $parentExceptions = Collection::make(class_parents($class));

        foreach ($parentExceptions as $exceptionClass) {
            if ($this->exceptions->has($exceptionClass)) {
                call_user_func_array($this->exceptions->get($exceptionClass), [$e, $bot]);

                return;
            }
        }

        // No matching parent exception, throw the exception away
        throw $e;
    }

    /**
     * Register a new exception type.
     *
     * @param string $exception
     * @param callable $closure
     * @return void
     */
    public function register(string $exception, callable $closure)
    {
        $this->exceptions->put($exception, $closure);
    }
}
