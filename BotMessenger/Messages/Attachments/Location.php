<?php

namespace ChienIT\BotMessenger\Messages\Attachments;

class Location extends Attachment
{
    /**
     * Pattern that messages use to identify location attachment.
     */
    const PATTERN = '%%%_LOCATION_%%%';

    /** @var string */
