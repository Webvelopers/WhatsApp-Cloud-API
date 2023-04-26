<?php

namespace Webvelopers\WhatsAppCloudApi\Webhook\Notification;

use Webvelopers\WhatsAppCloudApi\Enums\MessageTypeEnum;
use Webvelopers\WhatsAppCloudApi\Models\Message;
use Webvelopers\WhatsAppCloudApi\Webhook\Notification\Support\Business;

/**
 *
 */
final class Text extends MessageNotification
{
    /**
     *
     */
    private string $message;

    /**
     *
     */
    public function __construct(string $id, Business $business, array $message, string $received_at)
    {
        parent::__construct($id, $business, $received_at);

        $text_message = Message::create([
            'message_id' => $id,
            'message_type' => MessageTypeEnum::TEXT,
            'message_data' => $message,
        ]);

        $this->message = $message['body'];
    }

    /**
     *
     */
    public function message(): string
    {
        return $this->message;
    }
}
