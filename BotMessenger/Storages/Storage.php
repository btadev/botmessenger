<?php

namespace ChienIT\BotMessenger\Storages;

use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Interfaces\StorageInterface;

class Storage implements StorageInterface
{
    /** @var StorageInterface */
    protected $driver = '';

     * @param callable $next
