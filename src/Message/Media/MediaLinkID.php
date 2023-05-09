<?php

namespace Webvelopers\WhatsAppCloudApi\Message\Media;

use Webvelopers\WhatsAppCloudApi\Message\Error\InvalidMessage;

/**
 *
 */
final class MediaLinkID extends MediaID
{
    /**
     * Type of media: Link
     */
    protected string $type = 'link';

    /**
     * Creates a new Message type Media Link ID.
     */
    public function __construct(string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL))
            throw new InvalidMessage();

        parent::__construct($url);
    }
}
