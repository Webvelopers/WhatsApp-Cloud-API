<?php

namespace Webvelopers\WhatsAppCloudApi\Message;

use Webvelopers\WhatsAppCloudApi\Message\Media\MediaID;

/**
 * 
 */
final class AudioMessage extends Message
{
    /**
     * 
     */
    protected string $type = 'audio';

    /**
     * Document identifier: WhatsApp Media ID or any Internet public link document.
     * You can get a WhatsApp Media ID uploading the document to the WhatsApp Cloud servers.
     */
    private MediaID $id;

    /**
     * 
     */
    public function __construct(string $to, MediaID $id)
    {
        $this->id = $id;

        parent::__construct($to);
    }

    /**
     * 
     */
    public function identifierType(): string
    {
        return $this->id->type();
    }

    /**
     * 
     */
    public function identifierValue(): string
    {
        return $this->id->value();
    }
}
