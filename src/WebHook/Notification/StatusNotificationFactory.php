<?php

namespace Webvelopers\WhatsAppCloudApi\WebHook\Notification;

use Webvelopers\WhatsAppCloudApi\WebHook\Notification\Support\Business;
use Webvelopers\WhatsAppCloudApi\WebHook\Notification\Support\Conversation;
use Webvelopers\WhatsAppCloudApi\WebHook\Notification\Support\Error;

/**
 *
 */
class StatusNotificationFactory
{
    /**
     *
     */
    public function buildFromPayload(array $metadata, array $status): StatusNotification
    {
        $notification = new StatusNotification(
            $status['id'],
            new Business($metadata['phone_number_id'], $metadata['display_phone_number']),
            $status['recipient_id'],
            $status['status'],
            $status['timestamp']
        );

        if (isset($status['conversation']))
            $notification->withConversation(new Conversation(
                $status['conversation']['id'],
                $status['conversation']['origin']['type'],
                $status['conversation']['expiration_timestamp'] ?? null,
            ));

        if (isset($status['errors']))
            $notification->withError(new Error(
                $status['errors'][0]['code'],
                $status['errors'][0]['title']
            ));

        return $notification;
    }
}
