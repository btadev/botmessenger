<?php

namespace ChienIT\BotMessenger\Interfaces;

use Symfony\Component\HttpFoundation\Response;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

interface DriverInterface
{
    /**
     * Determine if the request is for this driver.
     *
     * @return bool
     */
    public function matchesRequest();

    /**
     * Retrieve the chat message(s).
     *
     * @return array
     */
    public function getMessages();

    /**
     * @return bool
     */
    public function isConfigured();

    /**
     * Retrieve User information.
     * @param IncomingMessage $matchingMessage
     * @return UserInterface
     */
    public function getUser(IncomingMessage $matchingMessage);

    /**
     * @param IncomingMessage $message
     * @return \ChienIT\BotMessenger\Messages\Incoming\Answer
     */
    public function getConversationAnswer(IncomingMessage $message);

    /**
     * @param string|\ChienIT\BotMessenger\Messages\Outgoing\Question $message
     * @param IncomingMessage $matchingMessage
     * @param array $additionalParameters
     * @return $this
     */
    public function buildServicePayload($message, $matchingMessage, $additionalParameters = []);

        $keys = glob($this->path.'/*.json');
