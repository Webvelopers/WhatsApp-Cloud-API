<?php

namespace Webvelopers\WhatsAppCloudApi\Request;

use Webvelopers\WhatsAppCloudApi\Message\Message;
use Webvelopers\WhatsAppCloudApi\Request;

/**
 *
 */
abstract class MessageRequest extends Request implements RequestWithBody
{
    /**
     *
     */
    protected string $phone_number_id;

    /**
     *
     */
    public function __construct(string $phone_number_id, string $access_token, ?int $timeout = null)
    {
        $this->phone_number_id = $phone_number_id;

        parent::__construct($access_token, $timeout);
    }

    /**
     * Return WhatsApp Number Id for this request.
     */
    public function phoneNumberId(): string
    {
        return $this->phone_number_id;
    }

    /**
     * WhatsApp node path.
     */
    public function nodePath(): string
    {
        return $this->phone_number_id . '/messages';
    }
}
