<?php

namespace Webvelopers\WhatsAppCloudApi\Notification;

use Webvelopers\WhatsAppCloudApi\Notification\Support\Business;
use Webvelopers\WhatsAppCloudApi\Notification\Support\Conversation;
use Webvelopers\WhatsAppCloudApi\Notification\Support\Error;

/**
 *
 */
class StatusNotificationFactory
{
    /**
     *
     */
    protected array $metadata;

    /**
     *
     */
    protected array $status;

    /**
     *
     */
    public function buildFromPayload(array $metadata, array $status): StatusNotification
    {
        $this->metadata = $metadata;
        $this->status = $status;

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
                $status['errors'][0]['title'],
                $status['errors'][0]['message '],
                $status['errors'][0]['error_data '],
                $status['errors'][0]['details '],
            ));

        return $notification;
    }
}
