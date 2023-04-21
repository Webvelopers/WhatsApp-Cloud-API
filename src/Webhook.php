<?php

namespace Webvelopers\WhatsAppCloudApi;

use Webvelopers\WhatsAppCloudApi\WebHook\Notification;
use Webvelopers\WhatsAppCloudApi\WebHook\NotificationFactory;
use Webvelopers\WhatsAppCloudApi\WebHook\VerificationRequest;

/**
 *
 */
class WebHook
{
    /**
     * Verify a webhook anytime you configure a new one in your App Dashboard.
     */
    public function verify(array $payload, ?string $verify_token = null): string
    {
        return (new VerificationRequest($verify_token))->validate($payload);
    }

    /**
     * Get a notification from incoming webhook messages.
     */
    public function read(array $payload): ?Notification
    {
        return (new NotificationFactory())->buildFromPayload($payload);
    }
}
