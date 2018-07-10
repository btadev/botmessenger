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
```
