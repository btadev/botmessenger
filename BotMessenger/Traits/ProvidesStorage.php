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
  - <a href="https://hangouts.google.com"><img src="https://ssl.gstatic.com/chat/startpage/favicon_f1bac5c7ba3154b58080de921eb6d5ea.ico" width="32px"/></a> **Hangouts Chat**
