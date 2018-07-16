<?php

/*
 * This file is part of ChienIt Bot Messenger.
 *
 * (c) Nguyen Duc Chien <chiendevit@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
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
     */
    public function __construct($message = null, Attachment $attachment = null)
    {
        $this->message = $message;
        $this->attachment = $attachment;
    }

    /**
     * @param string $message
     * @param Attachment $attachment
     * @return OutgoingMessage
     */
    public static function create($message = null, Attachment $attachment = null)
    {
        return new self($message, $attachment);
    }

    /**
     * @param string $message
     * @return $this
     */
    public function text($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param \ChienIT\BotMessenger\Messages\Attachments\Attachment $attachment
     * @return $this
     */
    public function withAttachment(Attachment $attachment)
    {
        $this->attachment = $attachment;

        return $this;
    }

    /**
     * @return \ChienIT\BotMessenger\Messages\Attachments\Attachment
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->message;
    }
}
