<?php

namespace ChienIT\BotMessenger\Cache;

use ChienIT\BotMessenger\Interfaces\CacheInterface;

class CodeIgniterCache implements CacheInterface
{
    /**
     * @var array
     */
    private $cache;

    /**
     * @param array $driver
     */
    public function __construct($driver)
    {
        $this->cache = $driver;
    }

    /**
     * Determine if an item exists in the cache.
     *
     * @param  string $key
     * @return bool
     */
    public function has($key)
    {
        return $this->cache->get($key) !== false;
    }

    /**
     * Retrieve an item from the cache by key.
     *
    /**
