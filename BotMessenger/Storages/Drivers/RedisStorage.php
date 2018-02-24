<?php

namespace ChienIT\BotMessenger\Storages\Drivers;

use Redis;
use RuntimeException;
use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Interfaces\StorageInterface;

class RedisStorage implements StorageInterface
    /**
