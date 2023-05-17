<?php

namespace Webvelopers\WhatsAppCloudApi\Notifications\Object;

use Webvelopers\WhatsAppCloudApi\Notifications\MessageNotification;
use Webvelopers\WhatsAppCloudApi\Notifications\Support\Business;

/**
 *
 */
final class Text extends MessageNotification
{
    /**
     *
     */
    private string $message;

    /**
     *
     */
    public function __construct(string $id, Business $business, array $message, string $received_at)
    {
        parent::__construct($id, $business, $received_at);

        $this->message = $message['body'];
    }

    /**
     *
     */
    public function message(): string
    {
        return $this->message;
    }
}
