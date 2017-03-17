<?php

namespace ChienIT\BotMessenger\Drivers\Events;

use ChienIT\BotMessenger\Interfaces\DriverEventInterface;

class GenericEvent implements DriverEventInterface
{
    protected $payload;
    protected $name;

    /**
     * @param $payload
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Return the event name to match.
     *
     * @return string
     */
    public function getName()
    {
