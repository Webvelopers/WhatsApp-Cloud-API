<?php

namespace Webvelopers\WhatsAppCloudApi;

use Webvelopers\WhatsAppCloudApi\Notification;
use Webvelopers\WhatsAppCloudApi\Notification\NotificationFactory;
use Webvelopers\WhatsAppCloudApi\Request\VerificationRequest;

/**
 * .
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
