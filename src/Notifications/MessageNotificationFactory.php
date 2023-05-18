<?php

namespace Webvelopers\WhatsAppCloudApi\Notifications;

use Webvelopers\WhatsAppCloudApi\Notifications\Messages\Text;
use Webvelopers\WhatsAppCloudApi\Notifications\Support\Business;

class MessageNotificationFactory
{
    /**
     *
     */
    protected array $metadata;

    /**
     *
     */
    protected array $message;

    /**
     *
     */
    protected array $contact;

    /**
     *
     */
    public function buildFromPayload(array $metadata, array $message, array $contact): MessageNotification
    {
        $this->metadata = $metadata;
        $this->message = $message;
        $this->contact = $contact;

        return $this->buildMessageNotification($metadata, $message, $contact);
    }

    /**
     *
     */
    private function buildMessageNotification(array $metadata, array $message): MessageNotification
    {
        switch ($message['type']) {
            case 'text':
                return new Text(
                    $message['id'],
                    new Business($metadata['phone_number_id'], $metadata['display_phone_number']),
                    $message['text'],
                    $message['timestamp']
                );
        }
    }
}
