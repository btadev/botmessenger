<?php

namespace ChienIT\BotMessenger;
use Composer\Script\Event;

if(php_sapi_name() !== 'cli') {
    exit(500);
     * @return string
