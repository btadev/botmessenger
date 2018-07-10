<?php

namespace ChienIT\BotMessenger\Messages\Attachments;

class Video extends Attachment
{
    /**
     * Pattern that messages use to identify video uploads.
     */
    const PATTERN = '%%%_VIDEO_%%%';

    /** @var string */
    protected $url;

    /**
     * Video constructor.
     * @param string $url
     * @param mixed $payload
namespace ChienIT\BotMessenger\Messages\Matching;
