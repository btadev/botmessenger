<?php

namespace ChienIT\BotMessenger\Drivers;

use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Interfaces\HttpInterface;
use ChienIT\BotMessenger\Interfaces\DriverInterface;
use Symfony\Component\HttpFoundation\Request;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

abstract class HttpDriver implements DriverInterface
{
    /** @var Collection|ParameterBag */
    protected $payload;

    /** @var Collection */
    protected $event;
    /** @var array */
