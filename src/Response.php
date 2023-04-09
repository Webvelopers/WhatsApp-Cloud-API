<?php

namespace Webvelopers\WhatsAppCloudAPI;

use Webvelopers\WhatsAppCloudAPI\Exception\ResponseException;
use Webvelopers\WhatsAppCloudAPI\Http\RawResponse;

class Response
{
    /**
     * @var Request The original request that returned this response.
     */
    protected Request $request;

    /**
     * Return the original request that returned this response.
     */
    public function request(): Request
    {
        return $this->request;
    }

    /**
     * @var string The raw body of the response from Graph.
     */
    protected string $body;

    /**
     * Return the raw body response.
     */
    public function body(): string
    {
        return $this->body;
    }

    /**
     * @var array The decoded body of the Graph response.
     */
    protected array $decoded_body = [];

    /**
     * Return the decoded body response.
     */
    public function decodedBody(): array
    {
        return $this->decoded_body;
    }

    /**
     * @var array The headers returned from Graph.
     */
    protected array $headers;

    /**
     * Return the HTTP headers for this response.
     */
    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * @var int The HTTP status code response from Graph.
     */
    protected int $http_status_code;

    /**
     * Return the HTTP status code for this response.
     */
    public function httpStatusCode(): int
    {
        return $this->http_status_code;
    }

    /**
     * Creates a new Response entity.
     */
    public function __construct(Request $request, array $headers = [], string $body, int $http_status_code = 0)
    {
        $this->request = $request;
        $this->headers = $headers;
        $this->body = $body;
        $this->http_status_code = $http_status_code;

        $this->decodeBody();
    }

    /**
     * Convert the raw response into an array if possible.
     */
    public function decodeBody(): void
    {
        $this->decoded_body = json_decode($this->body, true) ?? [];
    }

    /**
     *
     */
    public static function fromClientResponse(Request $request, RawResponse $response): self
    {
        return new self(
            $request,
            $response->headers(),
            $response->body(),
            $response->httpResponseCode()
        );
    }

    /**
     * Return the access token that was used for this response.
     */
    public function accessToken(): string
    {
        return $this->request->accessToken();
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
     */
    public function throwException()
    {
        throw new ResponseException($this);
    }
}
