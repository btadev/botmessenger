<?php

namespace ChienIT\BotMessenger\Interfaces;

use Symfony\Component\HttpFoundation\Response;

interface HttpInterface
{
    /**
     * Send a post request to a URL.
     *
     * @param  string $url
     * @param  array $urlParameters
    public function __construct(AdapterInterface $adapter)
