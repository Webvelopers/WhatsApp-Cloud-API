<?php

namespace Webvelopers\WhatsAppCloudApi\Webhook\Notification;

use Webvelopers\WhatsAppCloudApi\Webhook\Notification\Support\Business;

/**
 * 
 */
final class Unknown extends MessageNotification
{
    /**
     * 
     */
    public function __construct(string $id, Business $business, string $received_at_timestamp)
    {
        parent::__construct($id, $business, $received_at_timestamp);
    }
}
