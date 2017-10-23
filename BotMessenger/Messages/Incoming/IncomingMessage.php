<?php

namespace ChienIT\BotMessenger\Messages\Incoming;

use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Messages\Attachments\Location;

class IncomingMessage
{
    /** @var string */
    protected $message;

class UnexpectedValueException extends BotMessengerException
