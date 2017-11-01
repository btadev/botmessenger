<?php

namespace ChienIT\BotMessenger\Messages;

use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Commands\Command;
use ChienIT\BotMessenger\Messages\Incoming\Answer;
use ChienIT\BotMessenger\Interfaces\DriverInterface;
use ChienIT\BotMessenger\Interfaces\Middleware\Matching;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

class Matcher
{
    /**
     * regular expression to capture named parameters but not quantifiers
     * @param  \Throwable $e
