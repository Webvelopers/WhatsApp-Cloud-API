<?php

namespace Webvelopers\WhatsAppCloudApi\Message\Media;

use Webvelopers\WhatsAppCloudApi\Message\Error\InvalidMessage;

/**
 *
 */
final class LinkID extends MediaID
{
    /**
     *
     */
    protected string $type = 'link';

    /**
     * Creates a new Message class.
     */
    public function __construct(string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL))
            throw new InvalidMessage();

        parent::__construct($url);
    }
}
