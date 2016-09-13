<?php

namespace ChienIT\BotMessenger;
use Composer\Script\Event;

if(php_sapi_name() !== 'cli') {
    exit(500);
}

class BotManager {
    
    protected static $event;
    
    public static function menu(Event $event) {
        self::showWelcome();
        self::$event = $event;
        
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        require $vendorDir . '/autoload.php';
        
        echo ' =====> MENU <====='.PHP_EOL;
        echo '1. Drive'.PHP_EOL;
        echo 'Input> ';
        switch(readline()) {
            case '1': self::getDriver();
        }
    }
    
     * @return string
