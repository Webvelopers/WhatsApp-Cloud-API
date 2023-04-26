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
    public function __construct(?ImageMessage $message, string $phone_number_id, string $access_token, ?int $timeout = null)
    {
        $this->message = $message;

        parent::__construct($phone_number_id, $access_token, $timeout);
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
            'image' => [
                'caption' => $this->message->caption(),
                $this->message->identifierType() => $this->message->identifierValue(),
            ],
        ];
    }
}
