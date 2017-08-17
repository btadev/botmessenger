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

