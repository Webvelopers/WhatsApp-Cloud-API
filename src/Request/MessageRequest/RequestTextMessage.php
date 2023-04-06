<?php

namespace Webvelopers\WhatsAppCloudAPI\Request\MessageRequest;

use Webvelopers\WhatsAppCloudAPI\Request\MessageRequest;

final class RequestTextMessage extends MessageRequest
{
    /**
    * {@inheritdoc}
    */
    public function body(): array
    {
        return [
            'messaging_product' => $this->message->messagingProduct(),
            'recipient_type' => $this->message->recipientType(),
            'to' => $this->message->to(),
            'type' => $this->message->type(),
            'text' => [
                'preview_url' => $this->message->previewUrl(),
                'body' => $this->message->text(),
            ],
        ];
    }
}
