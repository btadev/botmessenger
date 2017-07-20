<?php

namespace ChienIT\BotMessenger\Interfaces;

use Illuminate\Support\Collection;

interface StorageInterface
{
    /**
     * Save an item in the storage with a specific key and data.
     *
     * @param  array $data
     * @param  string $key

