<?php

namespace ChienIT\BotMessenger\Messages\Outgoing;

use JsonSerializable;
use ChienIT\BotMessenger\Interfaces\WebAccess;
use ChienIT\BotMessenger\Messages\Outgoing\Actions\Button;
use ChienIT\BotMessenger\Interfaces\QuestionActionInterface;

class Question implements JsonSerializable, WebAccess
{
    /** @var array */
    protected $actions;

    /** @var string */
    protected $text;

    /** @var string */
    protected $callback_id;

    /** @var string */
    protected $fallback;

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
            if(isset($pkged[$drive['name']])) echo ' [Installed]';
