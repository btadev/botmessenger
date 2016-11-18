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
     */
    public static function extend($methodName, $callable)
    {
        self::$extensions[$methodName] = $callable;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        try {
            return call_user_func_array(self::$extensions[$name], $arguments);
        } catch (\Exception $e) {
            throw new \BadMethodCallException("Method [$name] does not exist.");
        }
    }

    /**
     * Create a new BotMessenger instance.
     *
     * @param array $config
     * @param CacheInterface $cache
     * @param Request $request
     * @param StorageInterface $storageDriver
# [![ChienIT](https://s.gravatar.com/avatar/36d29d01ee8909a7d386291516a94edb?s=32)](https://github.com/chiendevit) *ChienIt Bot Messenger*
