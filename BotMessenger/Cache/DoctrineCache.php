<?php

namespace ChienIT\BotMessenger\Cache;

use Doctrine\Common\Cache\Cache;
use ChienIT\BotMessenger\Interfaces\CacheInterface;

class DoctrineCache implements CacheInterface
{
    /**
     * @var Cache
     */
    private $driver;

    /**
     * @param Cache $driver
     */
    public function __construct(Cache $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Determine if an item exists in the cache.
     *
     * @param  string $key
     * @return bool
     */
    public function has($key)
    {
        return $this->driver->contains($key);
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
        $value = $this->driver->fetch($key);
        if ($value !== false) {
            return $value;
        }

        return $default;
    }

    /**
     * Retrieve an item from the cache and delete it.
     *
     * @param  string $key

