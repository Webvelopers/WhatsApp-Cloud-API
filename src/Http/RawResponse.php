<?php

namespace Webvelopers\WhatsAppCloudAPI\Http;

final class RawResponse
{
    /**
     * @var array The response headers in the form of an associative array.
     */
    private array $headers;

    /**
     * Return the response headers.
     */
    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * @var string The raw response body.
     */
    private string $body;

    /**
     * Return the body of the response.
     */
    public function body(): string
    {
        return $this->body;
    }

    /**
     * @var int The HTTP status response code.
     */
    private $http_response_code;

    /**
     * Return the HTTP response code.
     */
    public function httpResponseCode(): int
    {
        return $this->http_response_code;
    }

    /**
     * Creates a new GraphRawResponse entity.
     */
    public function __construct($headers, string $body, int $http_status_code = 0)
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
     * Parse the raw headers and set as an array.
     */
    protected function setHeadersFromString(string $raw_headers)
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

    /**
     * Sets the HTTP response code from a raw header.
     */
    public function setHttpResponseCodeFromHeader($raw_response_headers)
    {
        list($version, $status, $reason) = array_pad(explode(' ', $raw_response_headers, 3), 3, null);
        $this->http_response_code = (int) $status;
    }
}
