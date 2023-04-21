<?php

namespace Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

use Webvelopers\WhatsAppCloudApi\Message\StickerMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

/**
 * 
 */
final class RequestStickerMessage extends MessageRequest
{
    /**
     * 
     */
    protected StickerMessage $message;

    /**
     * 
     */
    public function __construct(?StickerMessage $message, string $access_token, string $from_phone_number_id, ?int $timeout = null)
    {
        $this->message = $message;
        $this->from_phone_number_id = $from_phone_number_id;

        parent::__construct($message, $access_token, $timeout);
    }

    /**
     * 
     */
    public function body(): array
    {
        return [
            'messaging_product' => $this->message->messagingProduct(),
            'recipient_type' => $this->message->recipientType(),
            'to' => $this->message->to(),
            'type' => $this->message->type(),
            $this->message->type() => [
                $this->message->identifierType() => $this->message->identifierValue(),
            ],
        ];
    }
}
