<?php

namespace Webvelopers\WhatsAppCloudAPI\Request;

use Webvelopers\WhatsAppCloudAPI\Message;
use Webvelopers\WhatsAppCloudAPI\Request as RequestBase;

abstract class MessageRequest extends RequestBase
{
    /**
     * @var Message WhatsApp Message to be sent.
     */
    protected Message $message;

    /**
     *
     */
    public function __construct(Message $message, string $access_token)
    {
        $this->message = $message;

        parent::__construct($access_token);
    }
}
