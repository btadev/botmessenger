<?php

namespace ChienIT\BotMessenger;

use React\Socket\Server;
use ChienIT\BotMessenger\Http\Curl;
use React\EventLoop\LoopInterface;
use ChienIT\BotMessenger\Cache\ArrayCache;
use ChienIT\BotMessenger\Drivers\DriverManager;
use ChienIT\BotMessenger\Interfaces\CacheInterface;
use Symfony\Component\HttpFoundation\Request;
use ChienIT\BotMessenger\Interfaces\StorageInterface;
use ChienIT\BotMessenger\Storages\Drivers\FileStorage;

class BotMessengerFactory
{
    private static $extensions = [];

    /**
     * @param $methodName
     * @param $callable
    /**
