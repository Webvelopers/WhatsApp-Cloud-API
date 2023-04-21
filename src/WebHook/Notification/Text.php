<?php

namespace Webvelopers\WhatsAppCloudApi\WebHook\Notification;

use Webvelopers\WhatsAppCloudApi\WebHook\Notification\Support\Business;

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
    public function __construct(string $id, Business $business, string $message, string $received_at_timestamp)
    {
        parent::__construct($id, $business, $received_at_timestamp);

        $this->message = $message;
    }

    /**
     * 
     */
    public function message(): string
    {
        return $this->message;
    }
}
