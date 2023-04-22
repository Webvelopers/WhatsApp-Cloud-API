<?php

namespace Webvelopers\WhatsAppCloudApi;

/**
 *
 */
class App
{
    /**
     * @const string The name of the environment variable that contains the app access token.
     */
    public const ACCESS_TOKEN = 'WHATSAPP_CLOUD_API_ACCESS_TOKEN';

    /**
     * @const string The name of the environment variable that contains the app from phone number ID.
     */
    public const PHONE_NUMBER_ID = 'WHATSAPP_CLOUD_API_PHONE_NUMBER_ID';

    /**
     * Whatsapp Access Token.
     */
    protected string $access_token;

    /**
     * Phone Number ID.
     */
    protected string $phone_number_id;

    /**
     * Sends a Whatsapp text message.
     */
    public function __construct(?string $access_token = null, ?string $phone_number_id = null)
    {
        $this->access_token = $access_token ?? env('WHATSAPP_CLOUD_API_ACCESS_TOKEN', static::ACCESS_TOKEN);
        $this->phone_number_id = $phone_number_id ?? env('WHATSAPP_CLOUD_API_PHONE_NUMBER_ID', static::PHONE_NUMBER_ID);

        $this->validate($this->access_token, $this->phone_number_id);
    }

    /**
     * Returns the Facebook Whatsapp Access Token.
     */
    public function accessToken(): string
    {
        return $this->access_token;
    }

    /**
     * Returns the Facebook Phone Number ID.
     */
    public function phoneNumberId(): string
    {
        return $this->phone_number_id;
    }

    /**
     *
     */
    private function validate(string $access_token, string $phone_number_id): void
    {
        // validate by function type hinting
    }
}
