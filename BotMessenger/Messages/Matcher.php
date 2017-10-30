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
     * captures {name}, but not {1}, {1,}, or {1,2}.
     */
    const PARAM_NAME_REGEX = '/\{((?:(?!\d+,?\d+?)\w)+?)\}/';

    /** @var array */
    protected $matches;

    /**
     * @param IncomingMessage $message
     * @param Answer $answer
     * @param Command $command
     * @param DriverInterface $driver
     * @param Matching[] $middleware
     * @return bool
     */
    public function isMessageMatching(IncomingMessage $message, Answer $answer, Command $command, DriverInterface $driver, $middleware = [])
    {
        return $this->isDriverValid($driver->getName(), $command->getDriver()) &&
            $this->isRecipientValid($message->getRecipient(), $command->getRecipients()) &&
            $this->isPatternValid($message, $answer, $command->getPattern(), $command->getMiddleware() + $middleware);
    }

    /**
     * @param IncomingMessage $message
     * @param Answer $answer
     * @param string $pattern
     * @param Matching[] $middleware
     * @return int
     */
    public function isPatternValid(IncomingMessage $message, Answer $answer, $pattern, $middleware = [])
    {
        $this->matches = [];


