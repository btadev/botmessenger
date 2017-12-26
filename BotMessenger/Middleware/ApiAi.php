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

    /** @var string */
    protected $apiUrl = 'https://api.api.ai/v1/query?v=20150910';

    /** @var bool */
    protected $listenForAction = false;

    /**
     * Wit constructor.
     * @param string $token api.ai access token
     * @param string $lang language
     * @param HttpInterface $http
     */
