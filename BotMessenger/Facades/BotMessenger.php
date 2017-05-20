<?php

namespace ChienIT\BotMessenger\Facades;

use Illuminate\Support\Facades\Facade;

class BotMessenger extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'chienit_botmessenger';
    }
    {
