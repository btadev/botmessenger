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
