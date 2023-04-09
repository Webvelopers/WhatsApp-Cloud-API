<?php

namespace Webvelopers\WhatsAppCloudAPI;

use Webvelopers\WhatsAppCloudAPI\Http\ClientHandler;
use Webvelopers\WhatsAppCloudAPI\Http\GuzzleClientHandler;
use Webvelopers\WhatsAppCloudAPI\Request\TextMessageRequest;

class Client
{
    /**
     * @const string Default Graph URL.
     */
    public const DEFAULT_GRAPH_URL = 'https://graph.facebook.com';

    /**
     * @const string Default Graph version.
     */
    public const DEFAULT_GRAPH_VERSION = 'v16.0';

    /**
     * @const string Default Message Path.
     */
    public const DEFAULT_MESSAGE_PATH = 'messages';

    /**
     * @const int Default Timeout.
     */
    public const DEFAULT_TIMEOUT = 300; // 5 mins.

    /**
     * @var string Graph URL.
     */
    protected string $graph_url;

    /**
     * @var string Graph Version.
     */
    protected string $graph_version;

    /**
     * @var string Message Path.
     */
    protected string $message_path;

    /**
     * @var int MTimeout.
     */
    protected int $timeout;

    /**
     * @var string From Phone Number ID.
     */
    protected string $from_phone_number_id;

    /**
     * @var ClientHandler The HTTP client handler to send the request.
     */
    protected ClientHandler $handler;

    /**
     * @var string URL.
     */
    protected string $url;

    /**
     * Gets URL value.
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * Creates a new HTTP Client.
     */
    public function __construct(string $from_phone_number_id, ?string $graph_url = null, ?string $graph_version = null, ?string $message_path = null, ?int $timeout = null)
    {
        $this->from_phone_number_id = $from_phone_number_id;
        $this->graph_url = $graph_url ?? self::DEFAULT_GRAPH_URL;
        $this->graph_version = $graph_version ?? self::DEFAULT_GRAPH_VERSION;
        $this->message_path = $message_path ?? self::DEFAULT_MESSAGE_PATH;
        $this->timeout = $timeout ?? self::DEFAULT_TIMEOUT;

        $this->url = implode('/', [
            $this->graph_url,
            $this->graph_version,
            $this->from_phone_number_id,
            $this->message_path,
        ]);

        $this->handler = new GuzzleClientHandler();
    }

    /**
     * Send a message request to.
     */
    public function sendTextMessage(TextMessageRequest $request): Response
    {
        $raw_response = $this->handler->postJsonData(
            $this->url(),
            $request->headers(),
            $request->body()
        );

        $return_response = new Response(
            $request,
            $raw_response->headers(),
            $raw_response->body(),
            $raw_response->httpResponseCode()
        );

        if ($return_response->isError()) {
            $return_response->throwException();
        }

        return $return_response;
    }
}
