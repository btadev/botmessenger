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
        return $this;
