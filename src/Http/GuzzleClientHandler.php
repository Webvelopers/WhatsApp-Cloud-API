<?php

namespace Webvelopers\WhatsAppCloudApi\Http;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * Guzzle Client Handler.
 */
final class GuzzleClientHandler implements ClientHandler
{
    /**
     * Guzzle Client
     */
    private $guzzle_client;

    /**
     * Instantiates a new Guzzle Client Handler object.
     */
    public function __construct(?Client $guzzle_client = null)
    {
        $this->guzzle_client = $guzzle_client ?: new Client();
    }

    /**
     * Sends a GET request to the server and returns the raw response.
     */
    public function get(string $url, array $headers, int $timeout): RawResponse
    {
        $raw_handler_response = $this->guzzle_client->get($url, [
            'headers' => $headers,
            'timeout' => $timeout,
            'http_errors' => false,
        ]);

        return $this->buildResponse($raw_handler_response);
    }

    /**
     * Sends a POST request to the server and returns the response interface.
     */
    public function post(string $url, array $data, string $data_type, array $headers, int $timeout): ResponseInterface
    {
        return $this->guzzle_client->post($url, [
            $data_type => $data,
            'headers' => $headers,
            'timeout' => $timeout,
            'http_errors' => false,
        ]);
    }

    /**
     * Sends a JSON POST request to the server and returns the raw response.
     */
    public function postJsonData(string $url, array $json, array $headers, int $timeout): RawResponse
    {
        $raw_handler_response = $this->post($url, $json, 'json', $headers, $timeout);

        return $this->buildResponse($raw_handler_response);
    }

    /**
     * Sends a from POST request to the server and returns the raw response.
     */
    public function postFormData(string $url, array $form, array $headers, int $timeout): RawResponse
    {
        $raw_handler_response = $this->post($url, $form, 'multipart', $headers, $timeout);

        return $this->buildResponse($raw_handler_response);
    }

    /**
     * Returns the raw response.
     */
    protected function buildResponse(ResponseInterface $handler_response): RawResponse
    {
        return new RawResponse(
            $handler_response->getHeaders(),
            $handler_response->getBody(),
            $handler_response->getStatusCode()
        );
    }
}
