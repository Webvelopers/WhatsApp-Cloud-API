<?php

namespace Webvelopers\WhatsAppCloudApi\Webhook\Notification\Support;

/**
 * 
 */
final class ConversationType extends \MyCLabs\Enum\Enum
{
    /**
     * 
     */
    private const BUSINESS_INITIATED = 'business_initiated';

    /**
     * 
     */
    private const CUSTOMER_INITIATED = 'user_initiated';

    /**
     * 
     */
    private const REFERRAL_INITIATED = 'referral_conversion';
}
