<?php

namespace ChienIT\BotMessenger\Traits;

use Closure;
use Illuminate\Support\Collection;
use Opis\Closure\SerializableClosure;
use ChienIT\BotMessenger\Drivers\DriverManager;
use ChienIT\BotMessenger\Interfaces\ShouldQueue;
use ChienIT\BotMessenger\Messages\Outgoing\Question;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;
use ChienIT\BotMessenger\Messages\Conversations\Conversation;

trait HandlesConversations
{
    /**
     * @param \ChienIT\BotMessenger\Messages\Conversations\Conversation $instance
     * @param null|string $recipient
     * @param null|string $driver
     */
    public function startConversation(Conversation $instance, $recipient = null, $driver = null)
    public function getUrl()
