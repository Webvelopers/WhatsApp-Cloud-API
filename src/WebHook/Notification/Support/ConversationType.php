<?php

namespace Webvelopers\WhatsAppCloudApi\Webhook\Notification\Support;


use MyCLabs\Enum\Enum;

/**
 *
 */
final class ConversationType extends Enum
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
