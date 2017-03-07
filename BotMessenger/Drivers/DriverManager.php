<?php

namespace ChienIT\BotMessenger\Drivers;

use ChienIT\BotMessenger\Http\Curl;
use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Interfaces\HttpInterface;
use ChienIT\BotMessenger\Interfaces\DriverInterface;
use ChienIT\BotMessenger\Interfaces\VerifiesService;
use Symfony\Component\HttpFoundation\Request;

class DriverManager
{
    /**
     * @var array
     */
    protected static $drivers = [];

    /** @var array */
    protected $config;

    /** @var HttpInterface */
    protected $http;

    /**
     * DriverManager constructor.
     * @param array $config
     * @param HttpInterface $http
     */
    public function __construct(array $config, HttpInterface $http)
    {

