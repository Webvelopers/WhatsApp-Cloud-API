<?php

namespace Webvelopers\WhatsAppCloudApi;

use Webvelopers\WhatsAppCloudApi\Http\ClientHandler;
use Webvelopers\WhatsAppCloudApi\Http\GuzzleClientHandler;
use Webvelopers\WhatsAppCloudApi\Http\Responses\Response;
use Webvelopers\WhatsAppCloudApi\Http\Requests\Request;

/**
 * Client object.
 */
class Client
{
    /**
     * @const string Production Graph API URL.
     */
    public const GRAPH_URL = 'https://graph.facebook.com';

    /**
     * @const string Default Graph API version.
     */
    public const GRAPH_VERSION = 'v16.0';

    /**
     * Graph URL.
     */
    protected string $graph_url;

    /**
     * Graph version.
     */
    protected string $graph_version;

    /**
     * Handler
     */
    protected ClientHandler $handler;

    /**
     * Creates a new HTTP Client.
     */
    public function __construct(?string $graph_url = null, ?string $graph_version = null, ?ClientHandler $handler = null)
    {
        $this->graph_url = $graph_url ?? env('WHATSAPP_CLOUD_API_GRAPH_URL', static::GRAPH_URL);
        $this->graph_version = $graph_version ?? env('WHATSAPP_CLOUD_API_GRAPH_VERSION', static::GRAPH_VERSION);
        $this->handler = $handler ?? $this->defaultHandler();
    }

    /**
     * Send a message request to.
     *
     * @throws Webvelopers\WhatsAppCloudApi\Exceptions\ResponseException
     */
    public function sendMessage(Request $request): Response
    {
        $raw_response = $this->handler->postJsonData(
            $this->buildRequestUri($request->nodePath()),
            $request->body(),
            $request->headers(),
            $request->timeout()
        );

        $return_response = new Response(
            $request,
            $raw_response->body(),
            $raw_response->httpResponseCode(),
            $raw_response->headers()
        );

        if ($return_response->isError()) {
            $return_response->throwException();
        }

        $response = $return_response->decodedBody();

        return $return_response;
    }

    /**
     *
     */
    private function defaultHandler(): ClientHandler
    {
        return new GuzzleClientHandler();
    }

    /**
     *
     */
    private function buildBaseUri(): string
    {
        return "$this->graph_url/$this->graph_version/";
    }

    /**
     *
     */
    private function buildRequestUri(string $node_path): string
    {
        return $this->buildBaseUri() . $node_path;
    }

    /**
     * Returns the Graph Url.
     */
    public function graphUrl(): string
    {
        return $this->graph_url;
    }

    /**
     * Returns the Graph Version.
     */
    public function graphVersion(): string
    {
        return $this->graph_version;
    }
}
