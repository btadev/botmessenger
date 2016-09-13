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
    
    public function showWelcome() {
        echo '     ____        __     __  ___                                         '.PHP_EOL;
        echo '   / __ )____  / /_   /  |/  /__  _____________  ____  ____ ____  _____ '.PHP_EOL;
        echo '  / __  / __ \/ __/  / /|_/ / _ \/ ___/ ___/ _ \/ __ \/ __ `/ _ \/ ___/ '.PHP_EOL;
        echo ' / /_/ / /_/ / /_   / /  / /  __(__  |__  )  __/ / / / /_/ /  __/ /     '.PHP_EOL;
        echo '/_____/\____/\__/  /_/  /_/\___/____/____/\___/_/ /_/\__, /\___/_/      '.PHP_EOL;
        echo '                                                    /____/              '.PHP_EOL;
        echo PHP_EOL;
    }

    public static function getDriver() {
