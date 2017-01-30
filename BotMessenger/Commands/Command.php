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

