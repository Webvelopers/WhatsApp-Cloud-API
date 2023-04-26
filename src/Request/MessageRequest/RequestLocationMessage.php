<?php

namespace Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

use Webvelopers\WhatsAppCloudApi\Message\LocationMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

/**
 *
 */
final class RequestLocationMessage extends MessageRequest
{
    /**
     *
     */
    protected LocationMessage $message;

    /**
     *
     */
    public function __construct(?LocationMessage $message, string $phone_number_id, string $access_token, ?int $timeout = null)
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
                'longitude' => $this->message->longitude(),
                'latitude' => $this->message->latitude(),
                'name' => $this->message->name(),
                'address' => $this->message->address(),
            ],
        ];
    }
}
