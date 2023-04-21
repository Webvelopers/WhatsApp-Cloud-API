<?php

namespace Webvelopers\WhatsAppCloudApi\Http;

/**
 * 
 */
final class RawResponse
{
    /**
     * 
     */
    private array $headers;

    /**
     * 
     */
    private string $body;

    /**
     * 
     */
    private $http_response_code;

    /**
     * Creates a new GraphRawResponse entity.
     */
    public function __construct($headers, string $body, ?int $http_status_code = null)
    {
        if (is_numeric($http_status_code)) {
            $this->http_response_code = (int)$http_status_code;
        }

        if (is_array($headers)) {
            $this->headers = $headers;
        } else {
            $this->setHeadersFromString($headers);
        }

        $this->body = $body;
    }

    /**
     * Return the response headers.
     */
    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * Return the body of the response.
     */
    public function body(): string
    {
        return $this->body;
    }

    /**
     * Return the HTTP response code.
     */
    public function httpResponseCode(): int
    {
        return $this->http_response_code;
    }

    /**
     * Sets the HTTP response code from a raw header.
     */
    public function setHttpResponseCodeFromHeader($raw_response_headers)
    {
        list($version, $status, $reason) = array_pad(explode(' ', $raw_response_headers, 3), 3, null);
        $this->http_response_code = (int) $status;
    }

    /**
     * Parse the raw headers and set as an array.
     */
    protected function setHeadersFromString($raw_headers)
    {
        $raw_headers = str_replace("\r\n", "\n", $raw_headers);
        $header_collection = explode("\n\n", trim($raw_headers));
        $raw_header = array_pop($header_collection);
        $header_components = explode("\n", $raw_header);

        foreach ($header_components as $line) {
            if (strpos($line, ': ') === false) {
                $this->setHttpResponseCodeFromHeader($line);
            } else {
                list($key, $value) = explode(': ', $line, 2);
                $this->headers[$key] = $value;
            }
        }
    }
}
