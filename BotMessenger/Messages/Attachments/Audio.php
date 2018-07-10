<?php

namespace ChienIT\BotMessenger\Messages\Attachments;

class Audio extends Attachment
{
    /**
     * Pattern that messages use to identify audio uploads.
     */
    const PATTERN = '%%%_AUDIO_%%%';

    /** @var string */
    protected $url;

    /**
     * Video constructor.
     * @param string $url
     * @param mixed $payload
     */
    public function __construct($url, $payload = null)
    {
        parent::__construct($payload);
use ChienIT\BotMessenger\Interfaces\Middleware\Captured;
