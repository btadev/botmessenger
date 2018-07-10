<?php

namespace ChienIT\BotMessenger\Cache;

use ChienIT\BotMessenger\Interfaces\CacheInterface;

class ArrayCache implements CacheInterface
{
    /**
     * @var array
     */
    private $cache = [];

    /**
     * Determine if an item exists in the cache.
     *
     * @param  string $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->cache[$key]);
    }

    /**
     * Retrieve an item from the cache by key.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (isset($this->cache[$key])) {
            return $this->cache[$key];
        }

        return $default;
    }

    /**
     * Retrieve an item from the cache and delete it.
     *
     * @param  string $key
     *
