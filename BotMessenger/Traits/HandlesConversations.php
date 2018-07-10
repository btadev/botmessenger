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
    {
        $conversation_cache_time = $instance->getConversationCacheTime();

        $this->cache->put($this->message->getConversationIdentifier(), [
            'conversation' => $instance,
            'question' => serialize($question),
            'additionalParameters' => serialize($additionalParameters),
            'next' => $this->prepareCallbacks($next),
            'time' => microtime(),
        ], $conversation_cache_time ?? $this->config['config']['conversation_cache_time'] ?? 30);
    }

    /**
     * Get a stored conversation array from the cache for a given message.
     *
     * @param null|IncomingMessage $message
     * @return array
     */
    public function getStoredConversation($message = null)
    {
        if (is_null($message)) {
            $message = $this->getMessage();
        }

        $conversation = $this->cache->get($message->getConversationIdentifier());
        if (is_null($conversation)) {
            $conversation = $this->cache->get($message->getOriginatedConversationIdentifier());
        }

        return $conversation;
    }

    /**
     * Touch and update the current conversation.
     *
     * @return void
     */
    public function touchCurrentConversation()
    {
        if (! is_null($this->currentConversationData)) {
            $touched = $this->currentConversationData;
            $touched['time'] = microtime();

            $this->cache->put($this->message->getConversationIdentifier(), $touched, $this->config['conversation_cache_time'] ?? 30);
        }
    }

    /**
     * Get the question that was asked in the currently stored conversation
     * for a given message.
     *
     * @param null|IncomingMessage $message
     * @return string|Question
     */
    public function getStoredConversationQuestion($message = null)
    {
        $conversation = $this->getStoredConversation($message);

        return unserialize($conversation['question']);
    }

    /**
     * Remove a stored conversation array from the cache for a given message.
     *
     * @param null|IncomingMessage $message
     */
    public function removeStoredConversation($message = null)
    {
        /*
         * Only remove it from the cache if it was not modified
         * after we loaded the data from the cache.
         */
        if ($this->getStoredConversation($message)['time'] == $this->currentConversationData['time']) {
            $this->cache->pull($this->message->getConversationIdentifier());
            $this->cache->pull($this->message->getOriginatedConversationIdentifier());
        }
    }

    /**
     * @param Closure $closure
     * @return string
     */
    public function serializeClosure(Closure $closure)
    {
        if ($this->getDriver()->serializesCallbacks() && ! $this->runsOnSocket) {
            return serialize(new SerializableClosure($closure, true));
        }

        return $closure;
    }

    /**
     * @param mixed $closure
     * @return string
     */
    protected function unserializeClosure($closure)
    {
        if ($this->getDriver()->serializesCallbacks() && ! $this->runsOnSocket) {
            return unserialize($closure);
        }

        return $closure;
    }

    /**
     * Prepare an array of pattern / callbacks before
     * caching them.
     *
     * @param array|Closure $callbacks
     * @return array
     */
    protected function prepareCallbacks($callbacks)
    {
        if (is_array($callbacks)) {
            foreach ($callbacks as &$callback) {
                $callback['callback'] = $this->serializeClosure($callback['callback']);
     * @return string
