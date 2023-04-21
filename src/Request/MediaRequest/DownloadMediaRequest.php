<?php

namespace Webvelopers\WhatsAppCloudApi\Request\MediaRequest;

use Webvelopers\WhatsAppCloudApi\Request;

/**
 *
 */
final class DownloadMediaRequest extends Request
{
    /**
     *
     */
    private string $media_id;

    /**
     * Creates a new Media Request instance.
     */
    public function __construct(string $media_id, string $access_token, ?int $timeout = null)
    {
        $this->media_id = $media_id;

        parent::__construct($access_token, $timeout);
    }

    /**
     * Media Identifier (Id).
     */
    public function mediaId(): string
    {
        return $this->media_id;
    }

    /**
     * WhatsApp node path.
     */
    public function nodePath(): string
    {
        return $this->media_id;
    }
}
