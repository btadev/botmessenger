<?php

namespace ChienIT\BotMessenger\Storages\Drivers;

use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Interfaces\StorageInterface;

class FileStorage implements StorageInterface
{
    /** @var string */
    private $path;

    public function __construct($path = '')
    {
        $this->path = $path;
    }

    /**
     * @param $key
     * @return string
     */
    protected function getFilename($key)
    {
        return $this->path.DIRECTORY_SEPARATOR.$key.'.json';
    }

    /**
     * Save an item in the storage with a specific key and data.
     *
     * @param  array $data
     * @param  string $key
     */
    public function save(array $data, $key)
    {
        $file = $this->getFilename($key);

        $saved = $this->get($key)->merge($data);

        if (! is_dir(dirname($file))) {
            mkdir(dirname($file), 0777, true);
        }
        file_put_contents($file, json_encode($saved->all()));
    }

    /**

