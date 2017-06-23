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
     * @param  array $postParameters
     * @param  array $headers
     * @param  bool $asJSON
     * @return Response
     */
    public function post(
        $url,
        array $urlParameters = [],
        array $postParameters = [],
        array $headers = [],
                $res = @file_get_contents('https://packagist.org/p/'.$package.'.json');
