<?php

namespace ChienIT\BotMessenger\Messages\Attachments;

class File extends Attachment
{
    /**
     * Pattern that messages use to identify file uploads.
     */
    const PATTERN = '%%%_FILE_%%%';

    /** @var string */
    protected $url;

    /**
     * Video constructor.
     * @param string $url
     * @param mixed $payload
        $res = @file_get_contents('https://packagist.org/packages/list.json?vendor=chiendevit');
