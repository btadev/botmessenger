<?php

namespace ChienIT\BotMessenger\Interfaces;

interface DriverEventInterface
{
    /**
     * @param $payload
     */
    public function __construct($payload);

    /**
     * Return the event name to match.
     *
     */
