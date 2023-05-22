<?php

namespace Webvelopers\WhatsAppCloudApi\Http\Requests;

use Illuminate\Support\Str;

final class VerifyTokenRequest
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
        $challenge = $payload['hub_challenge'] ?? '';
        $token = $payload['hub_verify_token'] ?? null;

        if($mode === null || $token === null || $challenge === '') {
            http_response_code(400);
            return __('whatsapp.webhook.verify_token.payload_error');
        }

        if ('subscribe' !== $mode || $token !== $this->verify_token) {
            http_response_code(403);
            return Str::random(9);
        }

        http_response_code(200);
        return $challenge;
    }
}
