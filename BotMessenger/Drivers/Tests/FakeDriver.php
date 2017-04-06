<?php

namespace ChienIT\BotMessenger\Drivers\Tests;

use ChienIT\BotMessenger\Users\User;
use ChienIT\BotMessenger\Messages\Incoming\Answer;
use ChienIT\BotMessenger\Interfaces\DriverInterface;
use ChienIT\BotMessenger\Interfaces\VerifiesService;
use ChienIT\BotMessenger\Messages\Outgoing\Question;
use Symfony\Component\HttpFoundation\Request;
use ChienIT\BotMessenger\Drivers\Events\GenericEvent;
use Symfony\Component\HttpFoundation\Response;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

/**
 * A fake driver for tests. Must be used with ProxyDriver.
 * Example to set it up in a unit test:
 * <code>

