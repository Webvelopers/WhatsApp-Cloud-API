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
    public function __construct(string $wa_id, string $id, Business $business, array $message, string $received_at)
    {
        parent::__construct($id, $business, $received_at);

        $text_message = Message::create([
            'app_sender' => false,
            'wa_id' => $wa_id,
            'message_id' => $id,
            'message_type' => MessageTypeEnum::TEXT,
            'message_content' => json_encode($message),
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
