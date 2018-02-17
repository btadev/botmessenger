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

    /**
     * Save an item in the storage with a specific key and data.
     *
     * @param  array $data
     * @param  string $key
     */
    public function save(array $data, $key)
    {
        $this->redis->set($this->decorateKey($key), $data);
    }

    /**
     * Retrieve an item from the storage by key.
     *
     * @param  string $key
     * @return Collection
     */
    public function get($key)
    {
                call_user_func_array($this->exceptions->get($exceptionClass), [$e, $bot]);
