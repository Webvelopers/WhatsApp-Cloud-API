<?php

namespace Webvelopers\WhatsAppCloudAPI;

use Webvelopers\WhatsAppCloudAPI\Message\TextMessage;
use Webvelopers\WhatsAppCloudAPI\Request\TextMessageRequest;
use Webvelopers\WhatsAppCloudAPI\Response;

class WhatsAppCloudAPI
{
    /**
     * @var App The WhatsApp Cloud API App entity.
     */
    protected App $app;

    /**
     * @var Client The WhatsApp Cloud API client service.
     */
    protected Client $client;

    /**
     * Instantiates a new WhatsAppCloudAPI super-class object.
     */
    public function __construct(array $config)
    {
        $config = array_merge([
            // App
            'access_token' => '',
            // Client
            'from_phone_number_id' => null,
            'graph_url' => null,
            'graph_version' => null,
            'message_path' => null,
            'timeout' => null,
        ], $config);

        $this->app = new App($config['access_token']);
        $this->client = new Client($config['from_phone_number_id'], $config['graph_url'], $config['graph_version'], $config['message_path'], $config['timeout']);
    }

    /**
     * Sends a Whatsapp text message.
     */
    public function sendTextMessage(string $to, string $text, bool $preview_url = false): Response
    {
        $textMessage = new TextMessage($to, $text, $preview_url);
        $textMessageRequest = new TextMessageRequest(
            $textMessage,
            $this->app->accessToken()
        );

        return $this->client->sendTextMessage($textMessageRequest);
    }
}
