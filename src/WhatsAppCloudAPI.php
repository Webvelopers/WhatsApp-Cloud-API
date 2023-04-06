<?php

namespace Webvelopers\WhatsAppCloudAPI;

use Webvelopers\WhatsAppCloudAPI\Message\TextMessage;

class WhatsAppCloudAPI
{
    /**
     * @const string Default Graph API version.
     */
    public const DEFAULT_GRAPH_VERSION = 'v16.0';

    /**
     * @var WhatsAppCloudAPIApp The WhatsAppCloudApiApp entity.
     */
    protected WhatsAppCloudAPIApp $app;

    /**
     * @var Client The WhatsApp Cloud Api client service.
     */
    protected Client $client;

    /**
     * @var int The WhatsApp Cloud Api client timeout.
     */
    protected ?int $timeout;

    /**
     * Instantiates a new WhatsAppCloudAPI super-class object.
     */
    public function __construct(array $config)
    {
        $config = array_merge([
            'phone_number_id' => null,
            'access_token' => '',
            'graph_version' => static::DEFAULT_GRAPH_VERSION
        ], $config);

        $this->app = new WhatsAppCloudAPIApp($config['phone_number_id'], $config['access_token']);
        $this->client = new Client($config['graph_version']);
    }

    /**
     * Returns the WhatsApp Access Token.
     */
    public function accessToken(): string
    {
        return $this->app->accessToken();
    }

    /**
     * Returns the WhatsApp Phone Number ID.
     */
    public function phoneNumberId(): string
    {
        return $this->app->phoneNumberId();
    }

    /**
     * Sends a Whatsapp text message.
     */
    public function sendTextMessage(string $to, string $text, bool $preview_url = false): Response
    {
        $message = new TextMessage($to, $text, $preview_url);
        $request = new Request\MessageRequest\RequestTextMessage(
            $message,
            $this->app->accessToken(),
            $this->app->phoneNumberId(),
            $this->timeout
        );

        return $this->client->sendMessage($request);
    }

}
