<?php

namespace ChienIT\BotMessenger\Interfaces;

use Symfony\Component\HttpFoundation\Response;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

interface DriverInterface
{
    /**
     * Determine if the request is for this driver.
     *

