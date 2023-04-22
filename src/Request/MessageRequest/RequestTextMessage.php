<?php

namespace Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

use Webvelopers\WhatsAppCloudApi\Message\TextMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

/**
 *
 */
final class RequestTextMessage extends MessageRequest
{
    /**
     *
     */
    protected TextMessage $message;

    /**
     *
     */
    public function __construct(TextMessage $message, string $access_token, string $phone_number_id, ?int $timeout = null)
    {
        $this->message = $message;
        $this->phone_number_id = $phone_number_id;

        parent::__construct($message, $access_token, $phone_number_id, $timeout);
    }

    /**
     *
     */
    public function body(): array
    {
        return [
            'messaging_product' => $this->message->messagingProduct(),
            'recipient_type' => $this->message->recipientType(),
            'to' => $this->message->phoneNumber(),
            'type' => $this->message->type(),
            'text' => [
                'preview_url' => $this->message->previewUrl(),
                'body' => $this->message->textMessage(),
            ],
        ];
    }
}
