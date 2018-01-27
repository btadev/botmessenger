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
    public function __construct($token, $minimumConfidence, HttpInterface $http)
    {
        $this->token = $token;
        $this->http = $http;
    }

    /**
     * Create a new Wit middleware instance.
     * @param string $token wit.ai access token
     * @param float $minimumConfidence
     * @return Wit
     */
    public static function create($token, $minimumConfidence = 0.5)
    {
        return new static($token, $minimumConfidence, new Curl());
    }

    protected function getResponse(IncomingMessage $message)
    {
        $endpoint = 'https://api.wit.ai/message?q='.urlencode($message->getText());

        $this->response = $this->http->post($endpoint, [], [], [
            'Authorization: Bearer '.$this->token,
        ]);

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
     * @param \ChienIT\BotMessenger\Messages\Incoming\IncomingMessage $message
     * @param BotMessenger $bot
     * @param $next
     *
     * @return mixed
     */
    public function received(IncomingMessage $message, $next, BotMessenger $bot)
    {
        $response = $this->getResponse($message);

        $responseData = Collection::make(json_decode($response->getContent(), true));
        $message->addExtras('entities', $responseData->get('entities'));

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
        $entities = Collection::make($message->getExtras())->get('entities', []);

        if (! empty($entities)) {
        return $this->isInteractiveReply;
