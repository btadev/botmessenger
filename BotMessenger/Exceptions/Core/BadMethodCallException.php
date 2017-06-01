<?php

namespace ChienIT\BotMessenger\Exceptions\Core;

use ChienIT\BotMessenger\Exceptions\Base\BotMessengerException;

class BadMethodCallException extends BotMessengerException
{
    public function getUsername();
