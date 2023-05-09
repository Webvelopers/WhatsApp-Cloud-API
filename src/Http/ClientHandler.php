<?php

namespace Webvelopers\WhatsAppCloudApi\Http;

use Psr\Http\Message\ResponseInterface;

/**
 * Client Handler.
 */
interface ClientHandler
{
    /**
     * Sends a GET request to the server and returns the raw response.
     */
    public function get(string $url, array $headers, int $timeout): RawResponse;

    /**
     * Sends a POST request to the server and returns the response interface.
     */
    public function post(string $url, array $data, string $data_type, array $headers, int $timeout): ResponseInterface;

    /**
     * Sends a JSON POST request to the server and returns the raw response.
     */
    public function postJsonData(string $url, array $json, array $headers, int $timeout): RawResponse;

    /**
     * Sends a form POST request to the server and returns the raw response.
     */
    public function postFormData(string $url, array $form, array $headers, int $timeout): RawResponse;

}
