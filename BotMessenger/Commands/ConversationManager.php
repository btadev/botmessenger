<?php

namespace ChienIT\BotMessenger\Commands;

use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Messages\Matcher;
use ChienIT\BotMessenger\Messages\Incoming\Answer;
use ChienIT\BotMessenger\Messages\Attachments\File;
use ChienIT\BotMessenger\Interfaces\DriverInterface;
use ChienIT\BotMessenger\Messages\Attachments\Audio;
use ChienIT\BotMessenger\Messages\Attachments\Image;
use ChienIT\BotMessenger\Messages\Attachments\Video;
use ChienIT\BotMessenger\Middleware\MiddlewareManager;
    public function getMatchingDriver(Request $request)
