<?php

namespace ChienIT\BotMessenger\Messages\Incoming;

class Answer
{
    /** @var string */
    protected $text;

    /** @var string */
    protected $value;

    /** @var string */
    protected $callbackId;

    /** @var IncomingMessage */
    protected $message;

    /** @var bool */
    protected $isInteractiveReply = false;

    /**
     * @param string $text
     * @return static
     */
    public static function create($text = '')
    {
        return new static($text);
use ChienIT\BotMessenger\Exceptions\Base\BotMessengerException;
