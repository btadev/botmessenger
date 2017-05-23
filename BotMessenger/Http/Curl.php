<?php

namespace ChienIT\BotMessenger\Http;

use ChienIT\BotMessenger\Interfaces\HttpInterface;
use Symfony\Component\HttpFoundation\Response;

class Curl implements HttpInterface
{
    /**
     * {@inheritdoc}
     */
    public function post(
        $url,
        array $urlParameters = [],
     * @return mixed|null
