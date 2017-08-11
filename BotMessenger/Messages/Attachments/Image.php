<?php

namespace ChienIT\BotMessenger\Messages\Attachments;

class Image extends Attachment
{
    /**
     * Pattern that messages use to identify image uploads.
     */
    const PATTERN = '%%%_IMAGE_%%%';

    /** @var string */
    protected $url;

    /** @var string */
    protected $title;

    /**
     * Video constructor.
     * @param string $url
     * @param mixed $payload
     */
    public function __construct($url, $payload = null)
    {
        parent::__construct($payload);
        $this->url = $url;
    }

    }
