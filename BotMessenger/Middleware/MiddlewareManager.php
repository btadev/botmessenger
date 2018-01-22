<?php

namespace ChienIT\BotMessenger\Middleware;

use Closure;
use ChienIT\BotMessenger\BotMessenger;
use Mpociot\Pipeline\Pipeline;
use ChienIT\BotMessenger\Interfaces\Middleware\Heard;
use ChienIT\BotMessenger\Interfaces\Middleware\Sending;
use ChienIT\BotMessenger\Interfaces\Middleware\Captured;
use ChienIT\BotMessenger\Interfaces\Middleware\Matching;
use ChienIT\BotMessenger\Interfaces\Middleware\Received;
use ChienIT\BotMessenger\Interfaces\MiddlewareInterface;

class MiddlewareManager
{
    /** @var Received[] */
    protected $received = [];
    /** @var Captured[] */
    protected $captured = [];
    /** @var Matching[] */
    protected $matching = [];
    /** @var Heard[] */
    protected $heard = [];
    /** @var Sending[] */
    protected $sending = [];
    /** @var BotMessenger */
    protected $chienit_botmessenger;

    public function __construct(BotMessenger $chienit_botmessenger)
    {
        $this->chienit_botmessenger = $chienit_botmessenger;
    }

    /**
     * @param Received[] ...$middleware
     * @return Received[]|$this
     */
    public function received(Received ...$middleware)
    {
        if (empty($middleware)) {
            return $this->received;
        }
        $this->received = array_merge($this->received, $middleware);

        return $this;
    }

    /**
     * @param Captured[] ...$middleware
     * @return Captured[]|$this
     */
    public function captured(Captured ...$middleware)
    {
        if (empty($middleware)) {
            return $this->captured;
        }
        $this->captured = array_merge($this->captured, $middleware);

        return $this;
    }

    /**
     * @param Matching[] ...$middleware
     * @return Matching[]|$this
     */
    public function matching(Matching ...$middleware)
    {
        if (empty($middleware)) {
            return $this->matching;
        }
        $this->matching = array_merge($this->matching, $middleware);

        return $this;
    }

    /**
     * @param Heard[] $middleware
     * @return Heard[]|$this
     */
    public function heard(Heard ...$middleware)
    {
        if (empty($middleware)) {
            return $this->heard;
        }
        $this->heard = array_merge($this->heard, $middleware);

        return $this;
    }

    /**
     * @param Sending[] $middleware
     * @return Sending[]|$this
     */
    public function sending(Sending ...$middleware)
    {
        if (empty($middleware)) {
            return $this->sending;
        }
        $this->sending = array_merge($this->sending, $middleware);

        return $this;
    }

    /**
     * @param string $method
     * @param mixed $payload
     * @param MiddlewareInterface[] $additionalMiddleware
     * @param Closure|null $destination
     * @return mixed
     */
    public function applyMiddleware($method, $payload, array $additionalMiddleware = [], Closure $destination = null)
    {
        $destination = is_null($destination) ? function ($payload) {
            return $payload;
        }
        : $destination;

        $middleware = $this->$method + $additionalMiddleware;

        return (new Pipeline())
            ->via($method)
            ->send($payload)
            ->with($this->chienit_botmessenger)
            ->through($middleware)
            ->then($destination);
    }
