<?php

namespace ChienIT\BotMessenger\Cache;

use Redis;
use RuntimeException;
use ChienIT\BotMessenger\Interfaces\CacheInterface;

/**
 * Redis <http://redis.io> cache backend
 * Requires phpredis native extension <https://github.com/phpredis/phpredis#installation>.
 */
class RedisCache implements CacheInterface
{
    const KEY_PREFIX = 'chienit_botmessenger:cache:';

    /** @var Redis */
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
        if (! class_exists('Redis')) {
            throw new RuntimeException('phpredis extension is required for RedisCache');
        }
        $this->host = $host;
        $this->port = $port;
        $this->auth = $auth;
        $this->connect();
    }

        return $this->url;
