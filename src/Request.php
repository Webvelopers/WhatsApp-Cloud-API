<?php

namespace Webvelopers\WhatsAppCloudAPI;

abstract class Request
{
    /**
     * @var string The access token to use for this request.
     */
    private string $access_token;

    /**
     * Return the access token for this request.
     */
    public function accessToken(): string
    {
        return $this->access_token;
    }

    /**
     * Creates a new Request entity.
     */
    public function __construct(string $access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * Return the headers for this request.
     */
    public function headers(): array
    {
        return [
            'Authorization' => "Bearer $this->access_token",
        ];
    }
}
