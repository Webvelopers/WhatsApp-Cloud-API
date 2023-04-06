<?php

namespace Webvelopers\WhatsAppCloudAPI;

class WhatsAppCloudAPIApp
{
    /**
     * @var string WhatsApp Phone Number ID.
     */
    protected string $phone_number_id;

    /**
     * @var string WhatsApp Access Token.
     */
    protected string $access_token;

    /**
     * Sends a WhatsApp text message.
     */
    public function __construct(string $phone_number_id, string $access_token)
    {
        $this->phone_number_id = $phone_number_id;
        $this->access_token = $access_token;
    }

    /**
     * Returns the WhatsApp Access Token.
     */
    public function accessToken(): string
    {
        return $this->access_token;
    }

    /**
     * Returns the WhatsApp Phone Number ID.
     */
    public function phoneNumberId(): string
    {
        return $this->phone_number_id;
    }
}
