<?php

namespace Webvelopers\WhatsAppCloudApi\Notifications;

use Webvelopers\WhatsAppCloudApi\Enums\WebhookType;
use Webvelopers\WhatsAppCloudApi\Models\Webhook;

final class Notification
{
    /**
     * Notification.
     */
    protected array $notification;

    /**
     * Instances of Class.
     */
    public function __construct(array $notification)
    {
        $this->notification = $notification;
    }

    public function set(): bool
    {
        Webhook::create([
            'type' => WebhookType::Notification,
            'data' => $this->notification,
        ]);

        return true;
    }
}
