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
    }

    /**
     * @param string $text
     */
    public function __construct($text = '')
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->text;
    }

    /**
     * @return bool
     */
    public function isInteractiveMessageReply()
    {
        return $this->isInteractiveReply;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
