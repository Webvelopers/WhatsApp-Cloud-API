<?php

namespace Webvelopers\WhatsAppCloudAPI\Request;

final class TextMessageRequest extends MessageRequest
{
    /**
     * Return body request.
     */
    public function body(): array
    {
        return [
            'messaging_product' => $this->message->messagingProduct(),
            'recipient_type' => $this->message->recipientType(),
            'to' => $this->message->to(),
            'type' => $this->message->type(),
            'text' => $this->message->object(),
        ];
    }
}
