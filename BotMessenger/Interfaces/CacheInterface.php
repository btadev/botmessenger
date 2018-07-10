<?php

namespace ChienIT\BotMessenger\Interfaces;

interface CacheInterface
{
    /**
     * Determine if an item exists in the cache.
     *
     * @param  string $key
     * @return bool
     */
    public function has($key);

    /**
     * Retrieve an item from the cache by key.
     *
     * @param  string $key
     * @param  mixed $default

