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
use ChienIT\BotMessenger\Interfaces\HttpInterface;
