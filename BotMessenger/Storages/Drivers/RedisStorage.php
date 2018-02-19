<?php

namespace ChienIT\BotMessenger\Storages\Drivers;

use Redis;
use RuntimeException;
use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Interfaces\StorageInterface;

class RedisStorage implements StorageInterface
{
    const KEY_PREFIX = 'chienit_botmessenger:storage:';

    /**
     * @var Redis
     */
    private $redis;
    private $host;
    private $port;
    private $auth;

    /**
     * RedisCache constructor.
     * @param $host
     * @param $port
     * @param $auth
     */
    public function __construct($host = '127.0.0.1', $port = 6379, $auth = null)
    {
        if (! class_exists(Redis::class)) {
            throw new RuntimeException('phpredis extension is required for RedisStorage');
        }
        $this->host = $host;
        $this->port = $port;
        $this->auth = $auth;
        $this->connect();
    }
     * @return mixed
