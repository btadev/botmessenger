<?php

/*
 * This file is part of ChienIt Bot Messenger.
 *
 * (c) Nguyen Duc Chien <chiendevit@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace ChienIT\BotMessenger\Drivers;

use ChienIT\BotMessenger\Users\User;
use ChienIT\BotMessenger\Messages\Incoming\Answer;
use Symfony\Component\HttpFoundation\Request;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

class NullDriver extends HttpDriver
{
    /**
     * @param Request $request
     */
    public function buildPayload(Request $request)
    {
    }

    /**
     * Determine if the request is for this driver.
     *
     * @return bool
     */
    public function matchesRequest()
    {
        return true;
    }

    /**
     * Return the driver name.
     *
     * @return string
     */
    public function getName()
    {
        return '';
    }

    /**
     * @param IncomingMessage $message
     *
     * @return Answer
     */
    public function getConversationAnswer(IncomingMessage $message)
    {
        return Answer::create('')->setMessage($message);
    }

    /**
     * Retrieve the chat message.
     *
     * @return string
     */
    public function getMessages()
    {
        return [new IncomingMessage('', '', '')];
    }

    /**
     * @return bool
     */
    public function isBot()
    {
        return false;
    }

    /**
     * @param string|\ChienIT\BotMessenger\Messages\Outgoing\Question $message
     * @param IncomingMessage $matchingMessage
     * @param array $additionalParameters
     * @return $this
     */
    public function buildServicePayload($message, $matchingMessage, $additionalParameters = [])
    {
    }

    /**
     * @param mixed $payload
     * @return Response
     */
    public function sendPayload($payload)
    {
    }

    /**
     * @return bool
     */
    public function hasMatchingEvent()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isConfigured()
    {
        return false;
    }

    /**
     * Retrieve User information.
     * @param IncomingMessage $matchingMessage
     * @return User
     */
    public function getUser(IncomingMessage $matchingMessage)
    {
        return new User();
    }

    /**
     * Low-level method to perform driver specific API requests.
     *
     * @param string $endpoint
     * @param array $parameters
     * @param IncomingMessage $matchingMessage
     * @return void
     */
    public function sendRequest($endpoint, array $parameters, IncomingMessage $matchingMessage)
    {
    }
}
