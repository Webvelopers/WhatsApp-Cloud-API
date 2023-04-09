<?php

namespace Webvelopers\WhatsAppCloudAPI\Http;

interface ClientHandler
{
    /**
     * Sends a JSON POST request to the server and returns the raw response.
     */
    public function postJsonData(string $url, array $headers, array $body): RawResponse;
}
