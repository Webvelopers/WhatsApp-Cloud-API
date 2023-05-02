<?php

namespace Webvelopers\WhatsAppCloudApi;

use Webvelopers\WhatsAppCloudApi\Request\VerificationRequest;
use Webvelopers\WhatsAppCloudApi\Webhook\Notification;
use Webvelopers\WhatsAppCloudApi\Webhook\NotificationFactory;

/**
 *
 */
class Webhook
{
    /**
     * Verify a Webhook anytime you configure a new one in your App Dashboard.
     */
    public function verify(array $payload, ?string $verify_token = null): string
    {
        return (new VerificationRequest($verify_token))->validate($payload);
    }

    /**
     * Get a notification from incoming Webhook messages.
     */
    public function read(array $payload): ?Notification
    {
        return (new NotificationFactory())->buildFromPayload($payload);
    }
}
