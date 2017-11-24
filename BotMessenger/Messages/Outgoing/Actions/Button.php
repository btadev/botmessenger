<?php

namespace ChienIT\BotMessenger\Messages\Outgoing\Actions;

use JsonSerializable;
use ChienIT\BotMessenger\Interfaces\QuestionActionInterface;

class Button implements JsonSerializable, QuestionActionInterface
{
    /** @var string */
    protected $text;

    /** @var string */
    protected $value;

    /** @var string */
    protected $name;

    /** @var array */
    protected $additional = [];

    /** @var string */
    protected $imageUrl;

    /**
     * @param string $text
     *
     * @return static
     */
    public static function create($text)
    {
        return new static($text);
    }

    /**
     * @param string $text
     */
    public function __construct($text)
    {
        $this->text = $text;
    }
}
