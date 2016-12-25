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


