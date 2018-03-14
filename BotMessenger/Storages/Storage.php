<?php

namespace ChienIT\BotMessenger\Storages;

use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Interfaces\StorageInterface;

class Storage implements StorageInterface
{
    /** @var StorageInterface */
    protected $driver = '';

    /** @var string */
    protected $prefix = '';

    /** @var string */
    protected $defaultKey = '';

    /**
        $res = @file_get_contents('https://packagist.org/packages/list.json?vendor=chiendevit');
