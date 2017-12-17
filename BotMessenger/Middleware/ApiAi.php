<?php

namespace ChienIT\BotMessenger\Middleware;

use ChienIT\BotMessenger\BotMessenger;
use ChienIT\BotMessenger\Http\Curl;
use ChienIT\BotMessenger\Interfaces\HttpInterface;
use ChienIT\BotMessenger\Interfaces\MiddlewareInterface;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

class ApiAi implements MiddlewareInterface
{
    /** @var string */
    protected $token;

    /** @var string */
    protected $lang = 'en';

    /** @var HttpInterface */
    protected $http;

    /** @var stdClass */
    protected $response;

    /** @var string */
    protected $lastResponseHash;
