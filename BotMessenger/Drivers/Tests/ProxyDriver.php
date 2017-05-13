<?php

namespace ChienIT\BotMessenger\Drivers\Tests;

use ChienIT\BotMessenger\Http\Curl;
use ChienIT\BotMessenger\Drivers\NullDriver;
use ChienIT\BotMessenger\Interfaces\DriverInterface;
use Symfony\Component\HttpFoundation\Request;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

/**
 * A driver that acts as a proxy for a global driver instance. Useful for mock/fake drivers in integration tests.
 */
final class ProxyDriver implements DriverInterface
{
