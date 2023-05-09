<?php

namespace Webvelopers\WhatsAppCloudApi\Message\Media;

abstract class MediaID
{
    /**
     * Type of media: Identifier or Link.
     */
    protected string $type;

    /**
     * Value: Identifier or link.
     */
    private string $value;

    /**
     * Creates a new Message class Media ID.
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Return type: Identifier or link.
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * Return value: Identifier or Link.
     */
    public function value(): string
    {
        return $this->value;
    }
}
