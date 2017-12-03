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

use ChienIT\BotMessenger\Interfaces\Middleware\Captured;
