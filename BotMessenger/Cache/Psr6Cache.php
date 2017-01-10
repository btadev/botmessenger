<?php

namespace ChienIT\BotMessenger\Cache;

use Psr\Cache\CacheItemPoolInterface;
use ChienIT\BotMessenger\Interfaces\CacheInterface;

class Psr6Cache implements CacheInterface
{
    /**
     * @var CacheItemPoolInterface
     */
    protected $adapter;

