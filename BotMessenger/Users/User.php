<?php

namespace ChienIT\BotMessenger\Users;

use ChienIT\BotMessenger\Interfaces\UserInterface;

class User implements UserInterface
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $first_name;

    /** @var string */
    protected $last_name;

    /** @var string */
    protected $username;

    /** @var array */
    protected $user_info;

    /**
{
