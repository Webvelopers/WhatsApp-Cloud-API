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
    public function __construct(?LocationMessage $message, string $access_token, string $from_phone_number_id, ?int $timeout = null)
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
                'longitude' => $this->message->longitude(),
                'latitude' => $this->message->latitude(),
                'name' => $this->message->name(),
                'address' => $this->message->address(),
            ],
        ];
    }
}
