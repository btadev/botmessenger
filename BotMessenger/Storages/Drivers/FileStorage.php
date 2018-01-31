<?php

namespace ChienIT\BotMessenger\Storages\Drivers;

use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Interfaces\StorageInterface;

class FileStorage implements StorageInterface
{
    /** @var string */
