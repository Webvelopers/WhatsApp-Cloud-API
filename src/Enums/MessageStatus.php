<?php

namespace Webvelopers\WhatsAppCloudApi\Enums;

enum MessageStatus: string
{
    /**
     * Sent message.
     */
    case Sent = 'sent';

    /**
     * Received message.
     */
    case Received = 'received';

    /**
     * Read message.
     */
    case Read = 'read';

    /**
     * Deleted message.
     */
    case Deleted = 'deleted';

    /**
     * Failed message.
     */
    case Failed = 'failed';
}
