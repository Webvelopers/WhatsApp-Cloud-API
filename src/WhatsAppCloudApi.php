<?php

namespace Webvelopers\WhatsAppCloudApi;

use Webvelopers\WhatsAppCloudApi\Messages\TextMessage;
use Webvelopers\WhatsAppCloudApi\Http\Requests\MessageReadRequest;
use Webvelopers\WhatsAppCloudApi\Http\Requests\MessageRequests\RequestTextMessage;
use Webvelopers\WhatsAppCloudApi\Http\Responses\Response;
use Webvelopers\WhatsAppCloudApi\Http\Responses\ResponseException;

/**
 * Super-class
 */
class WhatsAppCloudApi
{
    /**
     * App object
     */
    protected Application $app;

    /**
     * Client object
     */
    protected Client $client;

    /**
     * timeout
     */
    protected ?int $timeout;

    /**
     * Instantiates a new WhatsAppCloudApi super-class object.
     */
    public function __construct(array $config = [])
    {
        $config = array_merge([
            // Application
            'access_token' => null,
            'phone_number_id' => null,
            // Client
            'graph_url' => null,
            'graph_version' => null,
            'client_handler' => null,
            // Timeout
            'timeout' => null,
        ], $config);

        $this->app = new Application($config['access_token'], $config['phone_number_id']);
        $this->client = new Client($config['graph_url'], $config['graph_version'], $config['client_handler']);
        $this->timeout = $config['timeout'];
    }

    /**
     * Sends a Whatsapp text message.
     *
     * @throws ResponseException
     */
    public function sendTextMessage(string $to, string $body, bool $preview_url = false): Response
    {
        $message = new TextMessage($to, $body, $preview_url);
        $request = new RequestTextMessage(
            $message,
            $this->app->phoneNumberId(),
            $this->app->accessToken(),
            $this->timeout
        );

        return $this->client->sendMessage($request);
    }

    /**
     * Mark a message as read
     *
     * @throws ResponseException
     */
    public function markMessageAsRead(string $message_id): Response
    {
        $request = new MessageReadRequest(
            $message_id,
            $this->app->phoneNumberId(),
            $this->app->accessToken(),
            $this->timeout
        );

        return $this->client->sendMessage($request);
    }

    /**
     * Returns the Facebook Whatsapp Access Token.
     */
    public function accessToken(): string
    {
        return $this->app->accessToken();
    }

    /**
     * Returns the Facebook Phone Number ID.
     */
    public function phoneNumberId(): string
    {
        return $this->app->phoneNumberId();
    }

    /**
     * Returns the Graph Url.
     */
    public function graphUrl(): string
    {
        return $this->client->graphUrl();
    }

    /**
     * Returns the Graph Version.
     */
    public function graphVersion(): string
    {
        return $this->client->graphVersion();
    }

    /**
     * Returns the Graph Version.
     */
    public function timeout(): ?int
    {
        return $this->timeout;
    }
}
