<?php

namespace ChienIT\BotMessenger\Messages\Attachments;

use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Interfaces\WebAccess;

abstract class Attachment implements WebAccess
{
    /** @var mixed */
    protected $payload;

    /** @var array */
    protected $extras = [];

    /**
     * Attachment constructor.
     * @param mixed $payload
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

