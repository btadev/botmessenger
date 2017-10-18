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

    /** @var array */
    protected $extras = [];

    /** @var array */
    private $audio = [];

    /** @var array */
    private $files = [];

    /** @var \ChienIT\BotMessenger\Messages\Attachments\Location */
    private $location;

    /** @var bool */
    protected $isFromBot = false;

    public function __construct($message, $sender, $recipient, $payload = null)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->payload = $payload;
    }

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @return string
     * Retrieve an item from the cache and delete it.
