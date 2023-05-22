<?php

namespace Webvelopers\WhatsAppCloudApi;

use Webvelopers\WhatsAppCloudApi\Notifications\Notification;
use Webvelopers\WhatsAppCloudApi\Notifications\NotificationPayload;
use Webvelopers\WhatsAppCloudApi\Http\Requests\VerifyTokenRequest;

class Webhook
{
    /**
     * Verify a Webhook anytime you configure a new one in your App Dashboard.
     */
    public function verifyToken(array $payload, ?string $verify_token = null): string
    {
        if (!$this->validatePayload($payload)) {
            http_response_code(400);
            return __('whatsapp.webhook.verify_token.payload_error');
        }

        return (new VerifyTokenRequest($verify_token))->validate($payload);
    }

    /**
     * Webhooks are triggered when a customer performs an action or the status
     * for a message a business sends a customer changes.
     */
    public function notification(array $payload): ?Notification
    {
        return (new NotificationPayload())->buildFromPayload($payload);
    }

    /**
     * Validates verify token payload parameter.
     */
    protected function validatePayload(array $payload): bool
    {
        if (!array_key_exists('hub_mode', $payload) || !array_key_exists('hub_challenge', $payload) || !array_key_exists('hub_verify_token', $payload))
            return false;

        return true;
    }
}
