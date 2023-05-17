<?php

namespace Webvelopers\WhatsAppCloudApi\Http\Responses;

use Webvelopers\WhatsAppCloudApi\Http\RawResponse;
use Webvelopers\WhatsAppCloudApi\Http\Requests\Request;
use Webvelopers\WhatsAppCloudApi\Exceptions\ResponseException;

/**
 *
 */
class Response
{
    /**
     *
     */
    protected int $http_status_code;

    /**
     *
     */
    protected array $headers;

    /**
     *
     */
    protected string $body;

    /**
     *
     */
    protected array $decoded_body = [];

    /**
     *
     */
    protected Request $request;

    /**
     * Creates a new Response entity.
     */
    public function __construct(Request $request, string $body, ?int $http_status_code = null, array $headers = [])
    {
        $this->request = $request;
        $this->body = $body;
        $this->http_status_code = $http_status_code;
        $this->headers = $headers;

        $this->decodeBody();
    }

    /**
     *
     */
    public static function fromClientResponse(Request $request, RawResponse $response): self
    {
        return new self(
            $request,
            $response->body(),
            $response->httpResponseCode(),
            $response->headers()
        );
    }

    /**
     * Return the original request that returned this response.
     */
    public function request(): Request
    {
        return $this->request;
    }

    /**
     * Return the access token that was used for this response.
     */
    public function accessToken(): string
    {
        return $this->request->accessToken();
    }

    /**
     * Return the HTTP status code for this response.
     */
    public function httpStatusCode(): int
    {
        return $this->http_status_code;
    }

    /**
     * Return the HTTP headers for this response.
     */
    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * Return the raw body response.
     */
    public function body(): string
    {
        return $this->body;
    }

    /**
     * Return the decoded body response.
     */
    public function decodedBody(): array
    {
        return $this->decoded_body;
    }

    /**
     * Get the version of Graph that returned this response.
     */
    public function graphVersion(): ?string
    {
        return $this->headers['facebook-api-version'] ?? null;
    }

    /**
     * Returns true if Graph returned an error message.
     */
    public function isError(): bool
    {
        return isset($this->decoded_body['error']);
    }

    /**
     * Throws the exception.
     *
     * @throws ResponseException
     */
    public function throwException()
    {
        throw new ResponseException($this);
    }


    /**
     * Convert the raw response into an array if possible.
     */
    public function decodeBody(): void
    {
        $this->decoded_body = json_decode($this->body, true) ?? [];
    }
}
