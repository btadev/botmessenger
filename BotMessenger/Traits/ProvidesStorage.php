<?php

namespace ChienIT\BotMessenger\Traits;

use ChienIT\BotMessenger\Storages\Storage;

trait ProvidesStorage
{
    /**
     * @return Storage
     */
    public function userStorage()
    {
        return (new Storage($this->storage))
            ->setPrefix('user_')
            ->setDefaultKey($this->getMessage()->getSender());
    }

    /**
     * @return Storage
     */
    public function channelStorage()
    {
        return (new Storage($this->storage))
            ->setPrefix('channel_')
            ->setDefaultKey($this->getMessage()->getRecipient());
    }

    /**
     * @return Storage
     */
    public function driverStorage()
    {
        return (new Storage($this->storage))
    /**
