<?php

/*
 * This file is part of ChienIt Bot Messenger.
 *
 * (c) Nguyen Duc Chien <chiendevit@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
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
     */
    protected function getResponse(IncomingMessage $message)
    {
        $response = $this->http->post($this->apiUrl, [], [
            'query' => [$message->getText()],
            'sessionId' => md5($message->getConversationIdentifier()),
            'lang' => $this->lang,
        ], [
            'Authorization: Bearer '.$this->token,
            'Content-Type: application/json; charset=utf-8',
        ], true);

        $this->response = json_decode($response->getContent());

        return $this->response;
    }

    /**
     * Handle a captured message.
     *
     * @param \ChienIT\BotMessenger\Messages\Incoming\IncomingMessage $message
     * @param BotMessenger $bot
     * @param $next
     *
     * @return mixed
     */
    public function captured(IncomingMessage $message, $next, BotMessenger $bot)
    {
        return $next($message);
    }

    /**
     * Handle an incoming message.
     *
     * @param IncomingMessage $message
     * @param BotMessenger $bot
     * @param $next
     *
     * @return mixed
     */
    public function received(IncomingMessage $message, $next, BotMessenger $bot)
    {
        $response = $this->getResponse($message);

        $reply = isset($response->result->fulfillment->speech) ? $response->result->fulfillment->speech : '';
        $action = isset($response->result->action) ? $response->result->action : '';
        $actionIncomplete = isset($response->result->actionIncomplete) ? (bool) $response->result->actionIncomplete : false;
        $intent = isset($response->result->metadata->intentName) ? $response->result->metadata->intentName : '';
        $parameters = isset($response->result->parameters) ? (array) $response->result->parameters : [];

        $message->addExtras('apiReply', $reply);
        $message->addExtras('apiAction', $action);
        $message->addExtras('apiActionIncomplete', $actionIncomplete);
        $message->addExtras('apiIntent', $intent);
        $message->addExtras('apiParameters', $parameters);

        return $next($message);
    }

    /**
     * @param \ChienIT\BotMessenger\Messages\Incoming\IncomingMessage $message
     * @param string $pattern
     * @param bool $regexMatched Indicator if the regular expression was matched too
     * @return bool
     */
    public function matching(IncomingMessage $message, $pattern, $regexMatched)
    {
        if ($this->listenForAction) {
            $pattern = '/^'.$pattern.'$/i';

            return (bool) preg_match($pattern, $message->getExtras()['apiAction']);
        }

        return true;
    }

    /**
     * Handle a message that was successfully heard, but not processed yet.
     *
     * @param \ChienIT\BotMessenger\Messages\Incoming\IncomingMessage $message
     * @param BotMessenger $bot
     * @param $next
     *
     * @return mixed
     */
    public function heard(IncomingMessage $message, $next, BotMessenger $bot)
    {
        return $next($message);
    }

    /**
     * Handle an outgoing message payload before/after it
     * hits the message service.
     *
     * @param mixed $payload
     * @param BotMessenger $bot
     * @param $next
     *
     * @return mixed
     */
    public function sending($payload, $next, BotMessenger $bot)
    {
        return $next($payload);
    }
}
