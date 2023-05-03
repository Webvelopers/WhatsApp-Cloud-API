<?php

namespace Webvelopers\WhatsAppCloudApi\Notification\Object;

use Webvelopers\WhatsAppCloudApi\Notification\MessageNotification;
use Webvelopers\WhatsAppCloudApi\Notification\Support\Business;

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
