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
         * Use the driver name constant if we try to load a driver by it's
