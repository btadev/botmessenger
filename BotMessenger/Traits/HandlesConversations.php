<?php

namespace ChienIT\BotMessenger\Traits;

use Closure;
use Illuminate\Support\Collection;
use Opis\Closure\SerializableClosure;
use ChienIT\BotMessenger\Drivers\DriverManager;
use ChienIT\BotMessenger\Interfaces\ShouldQueue;
class InlineConversation extends Conversation
