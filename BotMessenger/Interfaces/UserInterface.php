<?php

namespace ChienIT\BotMessenger\Interfaces;

interface UserInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @return string
     */
    public function getLastName();

    /**
     * Get raw driver's user info.
     * @return array
     */
    public function getInfo();
}
    public function run()
