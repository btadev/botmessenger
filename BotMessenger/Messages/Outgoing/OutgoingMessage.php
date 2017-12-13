<?php

namespace ChienIT\BotMessenger\Messages\Outgoing;

use ChienIT\BotMessenger\Messages\Attachments\Attachment;

class OutgoingMessage
{
    /** @var string */
    protected $message;

    /** @var \ChienIT\BotMessenger\Messages\Attachments\Attachment */
    protected $attachment;

    /**
     * IncomingMessage constructor.
     * @param string $message
     * @param Attachment $attachment
