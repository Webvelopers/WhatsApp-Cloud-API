<?php

namespace Webvelopers\WhatsAppCloudApi\Webhook;

use Webvelopers\WhatsAppCloudApi\Models\Webhook;
use Webvelopers\WhatsAppCloudApi\Webhook\Notification\MessageNotificationFactory;
use Webvelopers\WhatsAppCloudApi\Webhook\Notification\StatusNotificationFactory;

/**
 *
 */
final class NotificationFactory
{
    /**
     * Message notification factory
     */
    private MessageNotificationFactory $message_notification_factory;

    /**
     * Status notification factory
     */
    private StatusNotificationFactory $status_notification_factory;

    /**
     * Notification factory
     */
    public function __construct()
    {
        $this->message_notification_factory = new MessageNotificationFactory();
        $this->status_notification_factory = new StatusNotificationFactory();
    }

    /**
     *
     */
    public function buildFromPayload(array $payload): ?Notification
    {
        if (!is_array($payload['entry'] ?? null)) {
            return null;
        }

        Webhook::create([
            'type' => 'read',
            'data' => $payload,
        ]);

        $entry = $payload['entry'][0] ?? [];
        $message = $entry['changes'][0]['value']['messages'][0] ?? [];
        $status = $entry['changes'][0]['value']['statuses'][0] ?? [];
        $contact = $entry['changes'][0]['value']['contacts'][0] ?? [];
        $metadata = $entry['changes'][0]['value']['metadata'] ?? [];

        if ($message) {
            return $this->message_notification_factory->buildFromPayload($metadata, $message, $contact);
        }

        if ($status) {
            return $this->status_notification_factory->buildFromPayload($metadata, $status);
        }

        return null;
    }
}
