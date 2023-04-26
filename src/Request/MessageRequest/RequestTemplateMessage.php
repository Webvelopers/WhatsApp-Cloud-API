<?php

namespace Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

use Webvelopers\WhatsAppCloudApi\Message\TemplateMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

/**
 *
 */
final class RequestTemplateMessage extends MessageRequest
{
    /**
     *
     */
    protected TemplateMessage $message;

    /**
     *
     */
    public function __construct(?TemplateMessage $message, string $phone_number_id, string $access_token, ?int $timeout = null)
    {
        $this->message = $message;

        parent::__construct($phone_number_id, $access_token, $timeout);
    }

    /**
     *
     */
    public function body(): array
    {
        $body = [
            'messaging_product' => $this->message->messagingProduct(),
            'recipient_type' => $this->message->recipientType(),
            'to' => $this->message->phoneNumber(),
            'type' => $this->message->type(),
            'template' => [
                'name' => $this->message->name(),
                'language' => ['code' => $this->message->language()],
                'components' => [],
            ],
        ];

        if ($this->message->header())
            $body['template']['components'][] = [
                'type' => 'header',
                'parameters' => $this->message->header(),
            ];

        if ($this->message->body())
            $body['template']['components'][] = [
                'type' => 'body',
                'parameters' => $this->message->body(),
            ];

        foreach ($this->message->buttons() as $button) {
            $body['template']['components'][] = $button;
        }

        return $body;
    }
}
