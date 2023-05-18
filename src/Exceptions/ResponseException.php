<?php

namespace Webvelopers\WhatsAppCloudApi\Exceptions;

use Webvelopers\WhatsAppCloudApi\Http\Responses\Response;

final class ResponseException extends \Exception
{
    /**
     *
     */
    private Response $response;

    /**
     *
     */
    private array $response_data;

    /**
     * Creates a ResponseException.
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->response_data = $response->decodedBody();
    }

    /**
     * Returns the HTTP status code
     */
    public function httpStatusCode(): int
    {
        return $this->response->httpStatusCode();
    }

    /**
     * Returns the raw response used to create the exception.
     */
    public function rawResponse(): string
    {
        return $this->response->body();
    }

    /**
     * Returns the decoded response used to create the exception.
     */
    public function responseData(): array
    {
        return $this->response_data;
    }

    /**
     * Returns the response entity used to create the exception.
     */
    public function response(): Response
    {
        return $this->response;
    }
}
