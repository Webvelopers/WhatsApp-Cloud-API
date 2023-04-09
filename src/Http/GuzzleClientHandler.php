<?php

namespace Webvelopers\WhatsAppCloudAPI\Http;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

final class GuzzleClientHandler implements ClientHandler
{
    /**
     * @var \GuzzleHttp\Client The Guzzle client.
     */
    private Client $guzzle_client;

    /**
     *
     */
    public function __construct()
    {
        $this->guzzle_client = new Client();
    }

    /**
     *
     */
    public function postJsonData(string $url, array $headers, array $body): RawResponse
    {
        $raw_handler_response = $this->post($url, $headers, 'json', $body);

        return $this->buildResponse($raw_handler_response);
    }

    /**
     *
     */
    protected function post(string $url, array $headers, string $data_type, array $data): ResponseInterface
    {
        return $this->guzzle_client->post($url, [
            'headers' => $headers,
            $data_type => $data,
            'http_errors' => false,
        ]);
    }

    /**
     *
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
