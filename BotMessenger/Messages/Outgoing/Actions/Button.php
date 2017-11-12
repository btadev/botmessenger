<?php

namespace ChienIT\BotMessenger\Messages\Outgoing\Actions;

use JsonSerializable;
use ChienIT\BotMessenger\Interfaces\QuestionActionInterface;

class Button implements JsonSerializable, QuestionActionInterface
{
    /** @var string */
    protected $text;

    /** @var string */
