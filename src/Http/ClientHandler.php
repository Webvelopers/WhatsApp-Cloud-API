<?php

namespace Webvelopers\WhatsAppCloudApi\Http;

/**
 *
 */
interface ClientHandler
{
    /**
     * Sends a JSON POST request to the server and returns the raw response.
     */
    public function postJsonData(string $url, array $body, array $headers, int $timeout): RawResponse;

    /**
     * Sends a form POST request to the server and returns the raw response.
     */
    public function postFormData(string $url, array $form, array $headers, int $timeout): RawResponse;

    /**
     * Sends a GET request to the server and returns the raw response.
     */
    public function get(string $url, array $headers, int $timeout): RawResponse;
}
