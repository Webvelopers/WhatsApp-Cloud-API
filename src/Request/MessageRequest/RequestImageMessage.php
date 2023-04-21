<?php

namespace Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

use Webvelopers\WhatsAppCloudApi\Message\ImageMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

/**
 * 
 */
final class RequestImageMessage extends MessageRequest
{
    /**
     * 
     */
    protected ImageMessage $message;

    /**
     * 
     */
    public function __construct(?ImageMessage $message, string $access_token, string $from_phone_number_id, ?int $timeout = null)
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
            'image' => [
                'caption' => $this->message->caption(),
                $this->message->identifierType() => $this->message->identifierValue(),
            ],
        ];
    }
}
