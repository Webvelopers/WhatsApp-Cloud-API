<?php

namespace Webvelopers\WhatsAppCloudApi\Notifications;

final class Message
{
    /**
     * Message.
     */
    protected array $message;

    /**
     * Instances of Class.
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

    public function save()
    {

    }
}
