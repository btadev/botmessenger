<?php

namespace ChienIT\BotMessenger\Exceptions\Core;

use ChienIT\BotMessenger\Exceptions\Base\BotMessengerException;

    public function __construct(Command $command, IncomingMessage $message, array $matches)
