<?php

namespace ChienIT\BotMessenger\Interfaces;

interface QuestionActionInterface
{
    /**
     * Array representation of the question action.
     *
     * @return array
     */
    public function toArray();
}
     * @param string|\ChienIT\BotMessenger\Messages\Outgoing\Question $message
