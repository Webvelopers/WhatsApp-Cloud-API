<?php

namespace Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

use Webvelopers\WhatsAppCloudApi\Message\DocumentMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

/**
 * 
 */
final class RequestDocumentMessage extends MessageRequest
{
    /**
     * 
     */
    protected DocumentMessage $message;

    /**
     * 
     */
    public function __construct(?DocumentMessage $message, string $access_token, string $from_phone_number_id, ?int $timeout = null)
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
            'document' => [
                'caption' => $this->message->caption(),
                'filename' => $this->message->filename(),
                $this->message->identifierType() => $this->message->identifierValue(),
            ],
        ];
    }
}
