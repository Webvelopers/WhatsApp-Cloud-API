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
    case Deleted = 'deleted'; // error code 131051.

    /**
     * Failed message.
     */
    case Failed = 'failed';
}
