<?php

namespace Webvelopers\WhatsAppCloudApi\Message;

use Webvelopers\WhatsAppCloudApi\Message\Media\MediaID;

/**
 *
 */
final class ImageMessage extends Message
{
    /**
     *
     */
    protected string $type = 'image';

    /**
     * Document identifier: WhatsApp Media ID or any Internet public link document.
     * You can get a WhatsApp Media ID uploading the document to the WhatsApp Cloud servers.
     */
    private MediaID $media_id;

    /**
     * Describes the specified document.
     */
    private ?string $caption;

    /**
     *
     */
    public function __construct(string $phone_number, MediaID $media_id, ?string $caption = '')
    {
        parent::__construct($phone_number);

        $this->media_id = $media_id;
        $this->caption = $caption;
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

    /**
     *
     */
    public function caption(): string
    {
        return $this->caption;
    }
}
