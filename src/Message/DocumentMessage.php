<?php

namespace Webvelopers\WhatsAppCloudApi\Message;

use Webvelopers\WhatsAppCloudApi\Message\Media\MediaID;

/**
 *
 */
final class DocumentMessage extends Message
{
    /**
     *
     */
    protected string $type = 'document';

    /**
     * Document identifier: WhatsApp Media ID or any Internet public link document.
     * You can get a WhatsApp Media ID uploading the document to the WhatsApp Cloud servers.
     */
    private MediaID $media_id;

    /**
     * Describes the filename for the specific document: eg. my-document.pdf.
     */
    private string $filename;

    /**
     * Describes the specified document.
     */
    private ?string $caption;

    /**
     *
     */
    public function __construct(string $phone_number, MediaID $media_id, string $filename, ?string $caption = '')
    {
        parent::__construct($phone_number);

        $this->media_id = $media_id;
        $this->filename = $filename;
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
     * Name of the document to show on a WhatsApp message.
     */
    public function filename(): string
    {
        return $this->filename;
    }

    /**
     *
     */
    public function caption(): string
    {
        return $this->caption;
    }
}
