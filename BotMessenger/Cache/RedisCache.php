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
namespace ChienIT\BotMessenger\Cache;
