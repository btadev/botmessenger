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
     * Storage constructor.
     * @param StorageInterface $driver
     */
    public function __construct(StorageInterface $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @param $key
     * @return string
     */
    protected function getKey($key)
    {
        return sha1($this->prefix.$key);
    }

    /**
     * @param string $prefix
     * @return $this
     */
        }
