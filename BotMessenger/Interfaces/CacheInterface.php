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
        //
