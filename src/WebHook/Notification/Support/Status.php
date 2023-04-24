<?php

namespace Webvelopers\WhatsAppCloudApi\Webhook\Notification\Support;

/**
 * 
 */
final class Status extends \MyCLabs\Enum\Enum
{
    /**
     * 
     */
    private const DELIVERED = 'delivered';

    /**
     * 
     */
    private const READ = 'read';

    /**
     * 
     */
    private const SENT = 'sent';

    /**
     * 
     */
    private const FAILED = 'failed';
}
