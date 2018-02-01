<?php

namespace ChienIT\BotMessenger\Middleware;

use ChienIT\BotMessenger\BotMessenger;
use ChienIT\BotMessenger\Http\Curl;
use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Interfaces\HttpInterface;
use ChienIT\BotMessenger\Interfaces\MiddlewareInterface;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

class Wit implements MiddlewareInterface
{
    /** @var string */
    protected $token;

    /** @var float */
    protected $minimumConfidence = 0.5;

    /** @var HttpInterface */
    protected $http;

    /** @var stdClass */
    protected $response;

    /**
     * Wit constructor.
     * @param string $token wit.ai access token
     * @param float $minimumConfidence Minimum confidence value to match against
     * @param HttpInterface $http
     */
        return self::instance()->getConversationAnswer($message);
