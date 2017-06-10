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

        return $this->executeRequest($request);
    }

    /**
     * Send a get request to a URL.
     *
     * @param  string $url
     * @param  array $urlParameters
     * @param  array $headers
     * @param  bool $asJSON
     * @return Response
     */
    public function get($url, array $urlParameters = [], array $headers = [], $asJSON = false)
    {
        $request = $this->prepareRequest($url, $urlParameters, $headers);

        return $this->executeRequest($request);
    }

    /**
     * Prepares a request using curl.
     *
     * @param  string $url [description]
     * @param  array $parameters [description]
    {
