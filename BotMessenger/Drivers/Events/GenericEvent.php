<?php

namespace ChienIT\BotMessenger\Drivers\Events;

use ChienIT\BotMessenger\Interfaces\DriverEventInterface;

class GenericEvent implements DriverEventInterface
{
    protected $payload;
    protected $name;

    public function put($key, $value, $minutes)
