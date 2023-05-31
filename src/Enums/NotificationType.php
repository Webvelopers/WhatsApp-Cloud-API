<?php

namespace Webvelopers\WhatsAppCloudApi\Enums;

enum NotificationType: string
{
    /**
     * Error or Message Error notification.
     */
    case Error = 'error';

    /**
     * Message received from a customer.
     */
    case Message = 'message';

    /**
     * Status of Message sent to a customer.
     */
    case Status = 'status';
}
