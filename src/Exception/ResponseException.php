<?php

namespace Webvelopers\WhatsAppCloudAPI\Exception;

use Webvelopers\WhatsAppCloudAPI\Response;

final class ResponseException extends \Exception
{
    /**
     * @var Response The response that threw the exception.
     */
    private $response;

    /**
     * Returns the response entity used to create the exception.
     */
    public function response()
    {
        return $this->response;
    }

    /**
     * @var array Decoded response.
     */
    private $response_data;

    /**
     * Returns the decoded response used to create the exception.
     */
    public function responseData()
    {
        return $this->response_data;
    }

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
    public function httpStatusCode()
    {
        return $this->response->httpStatusCode();
    }

    /**
     * Returns the raw response used to create the exception.
     */
    public function rawResponse()
    {
        return $this->response->body();
    }
}
