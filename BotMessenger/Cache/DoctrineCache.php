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
        "ChienIT"
