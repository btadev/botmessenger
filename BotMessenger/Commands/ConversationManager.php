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
use ChienIT\BotMessenger\Messages\Attachments\Location;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;
use ChienIT\BotMessenger\Messages\Matching\MatchingMessage;

class ConversationManager
{
    /**
     * Messages to listen to.
     * @var Command[]
     */
    protected $listenTo = [];

    public function listenTo(Command $command)
    {
        $this->listenTo[] = $command;
    }

    /**
  - <a href="https://facebook.com"><img src="https://static.xx.fbcdn.net/rsrc.php/yo/r/iRmz9lCMBD2.ico" width="32px"/></a> **Facebook Messenger Personal**
