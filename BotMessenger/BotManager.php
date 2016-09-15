<?php

namespace ChienIT\BotMessenger;
use Composer\Script\Event;

if(php_sapi_name() !== 'cli') {
    exit(500);
}

class BotManager {
    
    protected static $event;
    
     * @param BotMessenger $bot
