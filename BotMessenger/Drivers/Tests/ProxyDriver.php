<?php

namespace ChienIT\BotMessenger\Drivers\Tests;

use ChienIT\BotMessenger\Http\Curl;
use ChienIT\BotMessenger\Drivers\NullDriver;
use ChienIT\BotMessenger\Interfaces\DriverInterface;
use Symfony\Component\HttpFoundation\Request;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

/**
        if(empty($packages) || empty($packages['packageNames'])) die('The server responds incorrectly. Check your Internet connection !');
