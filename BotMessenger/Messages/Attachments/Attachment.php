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

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return Attachment
     */
    public function addExtras($key, $value)
    {
        $this->extras[$key] = $value;

        return $this;
    }

    /**
     * @param string|null $key
     * @return array
     */
    public function getExtras($key = null)
    {
        }
