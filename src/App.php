<?php

namespace Webvelopers\WhatsAppCloudAPI;

class App
{
    /**
     * @var string WhatsApp Access Token.
     */
    protected string $access_token;

    /**
     * Returns the WhatsApp Access Token.
     */
    public function accessToken(): string
    {
        return $this->access_token;
    }

    /**
     * Sends a WhatsApp text message.
     */
    public function __construct(string $access_token)
    {
        $this->access_token = $access_token;
    }
}
