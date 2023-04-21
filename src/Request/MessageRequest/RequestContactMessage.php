<?php

namespace Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

use Webvelopers\WhatsAppCloudApi\Message\ContactMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

/**
 * 
 */
final class RequestContactMessage extends MessageRequest
{
    /**
     * 
     */
    protected ContactMessage $message;

    /**
     * 
     */
    public function __construct(ContactMessage $message, string $access_token, string $from_phone_number_id, ?int $timeout = null)
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
        $message_type = $this->message->type();

        $body = [
            'messaging_product' => $this->message->messagingProduct(),
            'recipient_type' => $this->message->recipientType(),
            'to' => $this->message->to(),
            'type' => $this->message->type(),
            $message_type => [
                [
                    'name' => [
                        'formatted_name' => $this->message->fullName(),
                        'first_name' => $this->message->firstName(),
                        'last_name' => $this->message->lastName(),
                    ],
                ],
            ],
        ];

        foreach ($this->message->phones() as $phone) {
            $phone_array = [
                'phone' => $phone->number(),
                'type' => $phone->type()->getValue(),
            ];

            if (!empty($phone->waId())) {
                $phone_array['wa_id'] = $phone->waId();
            }

            $body[$message_type][0]['phones'][] = $phone_array;
        }

        return $body;
    }
}
