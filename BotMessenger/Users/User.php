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
     * User constructor.
     * @param $id
     * @param $first_name
     * @param $last_name
     * @param $username
     * @param $user_info
     */
    public function __construct($id = null, $first_name = null, $last_name = null, $username = null, $user_info = [])
    {
     */
