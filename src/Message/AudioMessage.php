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
    private MediaID $media_id;

    /**
     *
     */
    public function __construct(string $phone_number, MediaID $media_id)
    {
        parent::__construct($phone_number);

        $this->media_id = $media_id;
    }

    /**
     *
     */
    public function identifierType(): string
    {
        return $this->media_id->type();
    }

    /**
     *
     */
    public function identifierValue(): string
    {
        return $this->media_id->value();
    }
}
