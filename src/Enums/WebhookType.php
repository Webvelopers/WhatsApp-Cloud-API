<?php

namespace Webvelopers\WhatsAppCloudApi\Enums;

enum WebhookType: string
{
    /**
     * Verify token request.
     */
    case VerifyToken = 'verify-token';

    /**
     * Message received from a customer.
     */
    case Notification = 'notification';
}
