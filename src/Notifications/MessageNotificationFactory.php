<?php

namespace Webvelopers\WhatsAppCloudApi\Notifications;

/**
 *
 */
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

        $notification = $this->buildMessageNotification($metadata, $message, $contact);

        return $this->decorateNotification($notification, $message, $contact);
    }

    /**
     *
     */
    private function buildMessageNotification(array $metadata, array $message, array $contact): MessageNotification
    {
        switch ($message['type']) {
            case 'text':
                return new Text(
                    $contact['wa_id'],
                    $message['id'],
                    new Business($metadata['phone_number_id'], $metadata['display_phone_number']),
                    $message['text'],
                    $message['timestamp']
                );
        }
    }

    /**
     *
     */
    private function decorateNotification(MessageNotification $notification, array $message, array $contact): MessageNotification
    {
        if ($contact) {
            $notification->withCustomer(new Customer(
                $contact['wa_id'],
                $contact['profile']['name'],
                $message['from']
            ));
        }

        if (isset($message['context'])) {
            if (isset($message['context']['referred_product'])) {
                $referred_product = new ReferredProduct(
                    $message['context']['referred_product']['catalog_id'],
                    $message['context']['referred_product']['product_retailer_id']
                );
            }

            $notification->withContext(new Context(
                $message['context']['id'] ?? null,
                $message['context']['forwarded'] ?? false,
                $referred_product ?? null
            ));
        }

        if (isset($message['referral'])) {
            $notification->withReferral(new Referral(
                $message['referral']['source_id'] ?? '',
                $message['referral']['source_url'] ?? '',
                $message['referral']['source_type'] ?? '',
                $message['referral']['headline'] ?? '',
                $message['referral']['body'] ?? '',
                $message['referral']['media_type'] ?? '',
                $message['referral']['image_url'] ?? $message['referral']['video_url'] ?? '',
                $message['referral']['thumbnail_url'] ?? ''
            ));
        }

        return $notification;
    }
}
