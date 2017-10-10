<?php

namespace ChienIT\BotMessenger\Messages\Incoming;

use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Messages\Attachments\Location;

class IncomingMessage
{
    /** @var string */
    protected $message;

    /** @var string */
    protected $sender;

    /** @var string */
    protected $recipient;

    /** @var array */
    protected $images = [];

    /** @var array */
    protected $videos = [];

    /** @var mixed */
    protected $payload;

  - <a href="https://en.wikipedia.org/wiki/Web"><img src="http://giantstepsmn.com/wp-content/uploads/2016/10/website-icon.png" width="32px"/></a> **Web**
