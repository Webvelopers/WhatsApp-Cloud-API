<?php

namespace Webvelopers\WhatsAppCloudApi\Enums;

enum NotificationPayload: string
{
    /**
     * Verify token request.
     */
    case Message = 'message';

    /**
     * Message received from a customer.
     */
    case Status = 'status';
}
