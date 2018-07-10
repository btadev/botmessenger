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
  - <a href="https://en.wikipedia.org/wiki/Amazon_Alexa"><img src="https://upload.wikimedia.org/wikipedia/commons/c/cc/Amazon_Alexa_App_Logo.png" width="32px"/></a> **Amazon Alexa**
