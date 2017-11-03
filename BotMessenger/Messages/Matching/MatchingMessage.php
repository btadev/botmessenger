<?php

namespace ChienIT\BotMessenger\Messages\Matching;

use ChienIT\BotMessenger\Commands\Command;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

class MatchingMessage
{
    /** @var Command */
    protected $command;

interface WebAccess
