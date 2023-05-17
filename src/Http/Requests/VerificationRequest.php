<?php

namespace Webvelopers\WhatsAppCloudApi\Http\Requests\Request;

/**
 *
 */
final class VerificationRequest
{
    /**
     * @const string The name of the environment variable that contains the app access token.
     */
    public const VERIFY_TOKEN = 'WHATSAPP_CLOUD_API_VERIFY_TOKEN';

    /**
     * Verify Token field configured in your app's App Dashboard.
     * @link https://developers.facebook.com/docs/graph-api/Webhooks/getting-started?locale=en_US#configure-Webhooks-product
     */
    protected string $verify_token;

    /**
     *
     */
    public function __construct(?string $verify_token = null)
    {
        $this->verify_token = $verify_token ?? env('WHATSAPP_CLOUD_API_VERIFY_TOKEN', static::VERIFY_TOKEN);
    }

    /**
     *
     */
    public function validate(array $payload): string
    {
        $mode = $payload['hub_mode'] ?? null;
        $token = $payload['hub_verify_token'] ?? null;
        $challenge = $payload['hub_challenge'] ?? '';

        if ('subscribe' !== $mode || $token !== $this->verify_token) {
            http_response_code(403);

            return $challenge;
        }

        http_response_code(200);

        return $challenge;
    }
}
