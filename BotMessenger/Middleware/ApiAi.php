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
    public function __construct($token, HttpInterface $http, $lang = 'en')
    {
        $this->token = $token;
        $this->lang = $lang;
        $this->http = $http;
    }

    /**
     * Create a new API.ai middleware instance.
     * @param string $token api.ai access token
     * @param string $lang language
     * @return ApiAi
     */
    public static function create($token, $lang = 'en')
    {
        return new static($token, new Curl(), $lang);
    }

    /**
     * Restrict the middleware to only listen for API.ai actions.
     * @param  bool $listen
     * @return $this
     */
    public function listenForAction($listen = true)
    {
        $this->listenForAction = $listen;

        return $this;
    }

    /**
     * Perform the API.ai API call and cache it for the message.
     * @param  \ChienIT\BotMessenger\Messages\Incoming\IncomingMessage $message
     * @return stdClass
     * @param \DateTime|int $minutes
