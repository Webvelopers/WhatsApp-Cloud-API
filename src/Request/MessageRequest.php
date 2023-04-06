<?php

namespace Webvelopers\WhatsAppCloudAPI\Request;

use Webvelopers\WhatsAppCloudAPI\Message\Message;
use Webvelopers\WhatsAppCloudAPI\Request;

abstract class MessageRequest extends Request implements RequestWithBody
{
    /**
     * @var Message WhatsApp Message to be sent.
     */
    protected Message $message;

    /**
     * @var string WhatsApp Number Id from messages will sent.
     */
    private string $phone_number_id;

    public function __construct(Message $message, string $access_token, string $phone_number_id, ?int $timeout = null)
    {
        $this->message = $message;
        $this->phone_number_id = $phone_number_id;

        parent::__construct($access_token, $timeout);
    }

    /**
     * Return WhatsApp Number Id for this request.
     *
     * @return string
     */
    public function phoneNumberId(): string
    {
        return $this->phone_number_id;
    }

    /**
     * WhatsApp node path.
     *
     * @return string
     */
    public function nodePath(): string
    {
        return $this->phone_number_id . '/messages';
    }
}
