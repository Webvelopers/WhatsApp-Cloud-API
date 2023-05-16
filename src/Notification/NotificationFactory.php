<?php

namespace Webvelopers\WhatsAppCloudApi\Webhook;

use Webvelopers\WhatsAppCloudApi\Notification;
use Webvelopers\WhatsAppCloudApi\Enums\WebhookTypeEnum;
use Webvelopers\WhatsAppCloudApi\Models\Webhook;
use Webvelopers\WhatsAppCloudApi\Notification\MessageNotificationFactory;
use Webvelopers\WhatsAppCloudApi\Notification\StatusNotificationFactory;

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
            'webhook_type' => WebhookTypeEnum::Read,
            'webhook_data' => $payload,
        ]);

        $entry = $payload['entry'][0] ?? [];
        $contact = $entry['changes'][0]['value']['contacts'][0] ?? [];
        $errors = $entry['changes'][0]['value']['errors'][0] ?? [];
        $message = $entry['changes'][0]['value']['messages'][0] ?? [];
        $metadata = $entry['changes'][0]['value']['metadata'] ?? [];
        $status = $entry['changes'][0]['value']['statuses'][0] ?? [];

        if ($errors) {

        }

        if ($message) {
            return $this->message_notification_factory->buildFromPayload($metadata, $message, $contact);
        }

        if ($status) {
            return $this->status_notification_factory->buildFromPayload($metadata, $status);
        }

        return null;
    }
}
