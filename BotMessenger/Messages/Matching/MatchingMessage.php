<?php

namespace ChienIT\BotMessenger\Messages\Matching;

use ChienIT\BotMessenger\Commands\Command;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

class MatchingMessage
{
    /** @var Command */
    protected $command;

    /** @var IncomingMessage */
    protected $message;

    /** @var array */
    private $matches;

    /**
     * MatchingMessage constructor.
     * @param Command $command
     * @param IncomingMessage $message
     * @param array $matches
     */
    public function __construct(Command $command, IncomingMessage $message, array $matches)
        }
