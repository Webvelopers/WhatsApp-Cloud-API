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
        return (new VerifyTokenRequest($verify_token))->validate($payload);
    }

    /**
     * Webhooks are triggered when a customer performs an action or the status
     * for a message a business sends a customer changes.
     */
    public function read(array $payload): ?Notification
    {
        return (new NotificationPayload())->buildFromPayload($payload);
    }
}
