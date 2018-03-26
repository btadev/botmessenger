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
    {
        if (! is_null($recipient) && ! is_null($driver)) {
            $this->message = new IncomingMessage('', $recipient, '');
            $this->driver = DriverManager::loadFromName($driver, $this->config);
        }
        $instance->setBot($this);
        $instance->run();
    }

    /**
     * @param \ChienIT\BotMessenger\Messages\Conversations\Conversation $instance
     * @param array|Closure $next
     * @param string|Question $question
     * @param array $additionalParameters
     */
    public function storeConversation(Conversation $instance, $next, $question = null, $additionalParameters = [])
        return false;
