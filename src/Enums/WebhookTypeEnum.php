<?php

namespace Webvelopers\WhatsAppCloudApi\Enums;

/**
 * Webhook Type
 */
enum WebhookTypeEnum: string
{
    /**
     * Verify token.
     */
    case Verify = 'verify';

    /**
     * Read notification.
     */
    case Read = 'read';
}
