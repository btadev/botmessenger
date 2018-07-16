<?php

/*
 * This file is part of ChienIt Bot Messenger.
 *
 * (c) Nguyen Duc Chien <chiendevit@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
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
