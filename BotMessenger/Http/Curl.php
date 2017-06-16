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
        array $postParameters = [],
        array $headers = [],
        $asJSON = false
    ) {
        $request = $this->prepareRequest($url, $urlParameters, $headers);

        curl_setopt($request, CURLOPT_POST, count($postParameters));
        if ($asJSON === true) {
            curl_setopt($request, CURLOPT_POSTFIELDS, json_encode($postParameters));
        } else {
            curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($postParameters));
        }
    it, and giving a relevant date.
