<?php

/*
 * This file is part of ChienIt Bot Messenger.
 *
 * (c) Nguyen Duc Chien <chiendevit@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
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
        $res = @file_get_contents('https://packagist.org/packages/list.json?vendor=chiendevit');
        if(empty($res)) die('Unable to retrieve data from server. Check your Internet connection !');
        $packages = @json_decode($res, true);
        if(empty($packages) || empty($packages['packageNames'])) die('The server responds incorrectly. Check your Internet connection !');
        $drives = array();
        $i = 0;
        foreach($packages['packageNames'] as $package) {
            if(strpos($package, 'chiendevit/botmessenger-driver-') === 0) {
                $res = @file_get_contents('https://packagist.org/p/'.$package.'.json');
                if(empty($res)) die('Unable to retrieve data from server. Check your Internet connection !');
                $pkg = @json_decode($res, true);
                if(empty($pkg) || empty($pkg['packages'] || empty($pkg['packages'][$package]))) die('The server responds incorrectly. Check your Internet connection !');
                $pkg = $pkg['packages'][$package];
                $drives[++$i] = reset($pkg);
            }
        }
        $installed = json_decode(file_get_contents(self::$event->getComposer()->getConfig()->get('vendor-dir').'/composer/installed.json'), true);
        $pkged = array();
        foreach($installed as $pkg) {
            $pkged[$pkg['name']] = true;
        }
        echo 'Current Drive Lists are supported: '.PHP_EOL;
        foreach($drives as $i => $drive) {
            echo $i.'. ';
            echo str_replace(' driver for ChienIT Bot Messenger', '', $drive['description']);
            if(isset($pkged[$drive['name']])) echo ' [Installed]';
            echo PHP_EOL;
        }
        echo 'Input> ';
        $i = readline();
        if($drives[$i]) {
            chdir(dirname(self::$event->getComposer()->getConfig()->get('vendor-dir')));
            if(isset($pkged[$drives[$i]['name']])) {
                echo 'You want to uninstall drive '.$drives[$i]['name'].' ?';
                if(strtolower(readline()) == 'y') {
                    system('composer remove '.$drives[$i]['name']);
                }
            } else {
                echo 'You want to install drive '.$drives[$i]['name'].' ?';
                if(strtolower(readline()) == 'y') {
                    system('composer require '.$drives[$i]['name']);
                }
            }
        }
    }
}