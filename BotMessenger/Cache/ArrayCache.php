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
     * Return the event name to match.
