<?php

namespace ChienIT\BotMessenger\Middleware;

use Closure;
use ChienIT\BotMessenger\BotMessenger;
use Mpociot\Pipeline\Pipeline;
use ChienIT\BotMessenger\Interfaces\Middleware\Heard;
use ChienIT\BotMessenger\Interfaces\Middleware\Sending;
use ChienIT\BotMessenger\Interfaces\Middleware\Captured;
use ChienIT\BotMessenger\Interfaces\Middleware\Matching;
use ChienIT\BotMessenger\Interfaces\Middleware\Received;
use ChienIT\BotMessenger\Interfaces\MiddlewareInterface;

class MiddlewareManager
{
    /** @var Received[] */
    protected $received = [];
    /** @var Captured[] */
    protected $captured = [];
    /** @var Matching[] */
    protected $matching = [];
    /** @var Heard[] */
    protected $heard = [];
    /** @var Sending[] */
    protected $sending = [];
