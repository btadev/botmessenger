<?php

namespace ChienIT\BotMessenger\Commands;

use ChienIT\BotMessenger\Closure;
use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Interfaces\DriverInterface;
use ChienIT\BotMessenger\Interfaces\Middleware\Heard;
use ChienIT\BotMessenger\Interfaces\Middleware\Matching;

class Command
{
    /** @var string */
    protected $pattern;

    /** @var Closure|string */
    protected $callback;

    /** @var string */
    protected $in;

    /** @var string */
    protected $driver;

    /** @var array */
    protected $recipients;

    /** @var array */
    protected $middleware = [];

    /** @var bool */
    protected $stopsConversation = false;

    /** @var bool */
    protected $skipsConversation = false;

    /**
     * Command constructor.
     *
     * @param string $pattern
     * @param Closure|string $callback
     * @param array|null $recipients
     * @param string|null $driver
     */
    public function __construct($pattern, $callback, $recipients = null, $driver = null)
    {
        $this->pattern = $pattern;
        $this->callback = $callback;
        $this->driver = $driver;
        $this->recipients = $recipients;
    }

    /**
     * Apply possible group attributes.
     *
     * @param  array $attributes
     */
    public function applyGroupAttributes(array $attributes)
    {
        if (isset($attributes['middleware'])) {
            $this->middleware($attributes['middleware']);
        }

        if (isset($attributes['driver'])) {
            $this->driver($attributes['driver']);
        }

        if (isset($attributes['recipient'])) {
            $this->recipient($attributes['recipient']);
        }

        if (isset($attributes['stop_conversation']) && $attributes['stop_conversation'] === true) {
            $this->stopsConversation();
        }

        if (isset($attributes['skip_conversation']) && $attributes['skip_conversation'] === true) {
            $this->skipsConversation();
        }
    }

    /**
     * @param $driver
     * @return $this
     */
    public function driver($driver)
    {
        $this->driver = Collection::make($driver)->transform(function ($driver) {
            if (class_exists($driver) && is_subclass_of($driver, DriverInterface::class)) {
                $driver = basename(str_replace('\\', '/', $driver));
                $driver = preg_replace('/(.*)(Driver)$/', '$1', $driver);
            }

            return $driver;
        });

        return $this;
    }

    /**
     * With this command a current conversation should be stopped.
     */
    public function stopsConversation()
    {
        $this->stopsConversation = true;
    }

    /**
     * Tells if a current conversation should be stopped through this command.
     *
     * @return bool
     */
    public function shouldStopConversation()
    {
        return $this->stopsConversation;
    }

    /**
     * With this command a current conversation should be skipped.
     */
    public function skipsConversation()
    {
        $this->skipsConversation = true;
    }

    /**
     * Tells if a current conversation should be skipped through this command.
     *
     * @return bool
     */
    public function shouldSkipConversation()
    {
        return $this->skipsConversation;
    }

    /**
     * @param $recipients
     * @return $this
     */
    public function recipient($recipients)
    {
        $this->recipients = is_array($recipients) ? $recipients : [$recipients];

        return $this;
    }

    /**
     * @param array|Matching $middleware
     * @return $this
     */
    public function middleware($middleware)
    {
        if (! is_array($middleware)) {
    }
