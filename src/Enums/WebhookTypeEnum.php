<?php

namespace Webvelopers\WhatsAppCloudApi\Enums;

/**
 * Webhook Type
 */
enum WebhookTypeEnum: string
{
    /**
     * Verify Token
     */
    case Verify = 'verify';

    /**
     * Read Message
     */
    case Read = 'read';

    /**
     * Send Message
     */
    case Send = 'send';
}
