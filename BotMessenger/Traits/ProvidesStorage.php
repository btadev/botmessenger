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
<?php
