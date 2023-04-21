<?php

namespace Webvelopers\WhatsAppCloudApi;

use Webvelopers\WhatsAppCloudApi\Request\RequestWithBody;

abstract class Request implements RequestWithBody
{
    /**
     * @const int The timeout in seconds for a normal request.
     */
    public const REQUEST_TIMEOUT = 60;

    /**
     * @var string The access token to use for this request.
     */
    protected string $access_token;

    /**
     * The timeout request.
     *
     * @return int
     */
    private int $timeout;

    /**
     * Creates a new Request entity.
     *
     * @param Message               $message
     * @param string                $access_token
     */
    public function __construct(string $access_token, ?int $timeout = null)
    {
        $this->access_token = $access_token;
        $this->timeout = $timeout ?? env('WHATSAPP_CLOUD_API_REQUEST_TIMEOUT', self::REQUEST_TIMEOUT);
    }

    /**
     * Return the access token for this request.
     *
     * @return string
     */
    public function accessToken(): string
    {
        return $this->access_token;
    }

    /**
     * Return the timeout for this request.
     */
    public function timeout(): int
    {
        return $this->timeout;
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

    /**
     * Returns the raw body of the request.
     */
    public function body(): array
    {
        return [];
    }
}
