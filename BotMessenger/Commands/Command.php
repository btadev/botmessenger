<?php

namespace ChienIT\BotMessenger\Commands;

use ChienIT\BotMessenger\Closure;
use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Interfaces\DriverInterface;
use ChienIT\BotMessenger\Interfaces\Middleware\Heard;
use ChienIT\BotMessenger\Interfaces\Middleware\Matching;

class Command
{
    /** @var string */
    protected $pattern;

    /** @var Closure|string */
    protected $callback;

    /** @var string */
    protected $in;

    /** @var string */
    protected $driver;

    /** @var array */
    protected $recipients;

    /** @var array */
    protected $middleware = [];

    /** @var bool */
    protected $stopsConversation = false;

    /** @var bool */
    protected $skipsConversation = false;

    /**
     * Command constructor.
     *
     * @param string $pattern
     * @param Closure|string $callback
     * @param array|null $recipients
     * @param string|null $driver
     */
