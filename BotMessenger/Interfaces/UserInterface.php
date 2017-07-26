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
use ChienIT\BotMessenger\Users\User;
