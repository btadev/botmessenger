<?php

namespace ChienIT\BotMessenger\Messages\Attachments;

class Location extends Attachment
{
    /**
     * Pattern that messages use to identify location attachment.
     */
    const PATTERN = '%%%_LOCATION_%%%';

    /** @var string */
    protected $latitude;

    /** @var string */
    protected $longitude;

    /**
     * Message constructor.
     * @param string $latitude
     * @param string $longitude
     * @param mixed $payload

