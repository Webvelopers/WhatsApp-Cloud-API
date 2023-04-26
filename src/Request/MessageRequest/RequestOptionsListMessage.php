<?php

namespace Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

use Webvelopers\WhatsAppCloudApi\Message\OptionsListMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest;

/**
 *
 */
final class RequestOptionsListMessage extends MessageRequest
{
    /**
     *
     */
    protected OptionsListMessage $message;

    /**
     *
     */
    public function __construct(?OptionsListMessage $message, string $phone_number_id, string $access_token, ?int $timeout = null)
    {
        $this->message = $message;

        parent::__construct($phone_number_id, $access_token, $timeout);
    }

    /**
     *
     */
    public function body(): array
    {
        $request = [
            'messaging_product' => $this->message->messagingProduct(),
            'recipient_type' => $this->message->recipientType(),
            'to' => $this->message->phoneNumber(),
            'type' => 'interactive',
            'interactive' => [
                'type' => $this->message->type(),
                'header' => [
                    'type' => 'text',
                    'text' => $this->message->header(),
                ],
                'body' => ['text' => $this->message->body()],
                'action' => $this->message->action(),
            ],
        ];

        if ($this->message->footer())
            $request['interactive']['footer'] = ['text' => $this->message->footer()];

        return $request;
    }
}
