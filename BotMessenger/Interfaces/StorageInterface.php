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
     */
    public function save(array $data, $key);

    /**
     * Retrieve an item from the storage by key.
     *
     * @param  string $key
     * @return Collection
     */
    public function get($key);
     */