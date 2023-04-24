<?php

namespace Webvelopers\WhatsAppCloudApi\Webhook\Notification;

use Webvelopers\WhatsAppCloudApi\Webhook\Notification\Support\Business;

/**
 * 
 */
final class System extends MessageNotification
{
    /**
     * 
     */
    private string $message;

    /**
     * 
     */
    private Business $old_business_data;

    /**
     * 
     */
    public function __construct(string $id, Business $business, Business $old_business_data, string $message, string $received_at_timestamp)
    {
        parent::__construct($id, $business, $received_at_timestamp);

        $this->message = $message;
        $this->old_business_data = $old_business_data;
    }

    /**
     * 
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * 
     */
    public function oldBusinessPhoneNumberId(): string
    {
        return $this->old_business_data->phoneNumberId();
    }
}
