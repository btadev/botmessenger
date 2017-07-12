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
     * Pattern that messages use to identify file uploads.
