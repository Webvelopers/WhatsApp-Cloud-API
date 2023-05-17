<?php

namespace Webvelopers\WhatsAppCloudApi\Http\Requests\MessageRequests;

use Webvelopers\WhatsAppCloudApi\Messages\TextMessage;
use Webvelopers\WhatsAppCloudApi\Http\Requests\MessageRequest;

/**
 *
 */
final class RequestTextMessage extends MessageRequest
{
    /**
     * Text Message.
     */
    protected TextMessage $message;

    /**
     *
     */
    public function __construct(TextMessage $message, string $phone_number_id, string $access_token, ?int $timeout = null)
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
            'to' => $this->message->to(),
            'type' => $this->message->type(),
            'text' => [
                'preview_url' => $this->message->previewUrl(),
                'body' => $this->message->body(),
            ],
        ];
    }
}
