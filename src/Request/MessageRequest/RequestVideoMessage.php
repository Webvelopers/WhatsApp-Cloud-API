<?php

namespace Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

use Webvelopers\WhatsAppCloudApi\Message\VideoMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

/**
 *
 */
final class RequestVideoMessage extends MessageRequest
{
    /**
     *
     */
    protected VideoMessage $message;

    /**
     *
     */
    public function __construct(?VideoMessage $message, string $phone_number_id, string $access_token, ?int $timeout = null)
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
            $this->message->type() => [
                $this->message->identifierType() => $this->message->identifierValue(),
                'caption' => $this->message->caption(),
            ],
        ];
    }
}
