<?php

namespace Webvelopers\WhatsAppCloudApi;

use Webvelopers\WhatsAppCloudApi\Message\TextMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageReadRequest;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest\RequestTextMessage;
use Webvelopers\WhatsAppCloudApi\Response\ResponseException;

/**
 * Super-class
 */
class WhatsAppCloudApi
{
    /**
     * App object
     */
    protected App $app;

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
            'access_token' => null,
            'phone_number_id' => null,
            'graph_url' => null,
            'graph_version' => null,
            'client_handler' => null,
            'timeout' => null,
        ], $config);

        $this->app = new App($config['access_token'], $config['phone_number_id']);
        $this->client = new Client($config['graph_url'], $config['graph_version'], $config['client_handler']);
        $this->timeout = $config['timeout'];
    }

    /**
     * Sends a Whatsapp text message.
     *
     * @throws ResponseException
     */
    public function sendTextMessage(string $phone_number, string $text_message, bool $preview_url = false): Response
    {
        $message = new TextMessage($phone_number, $text_message, $preview_url);
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
