<?php

namespace Webvelopers\WhatsAppCloudApi\Request;

use Webvelopers\WhatsAppCloudApi\Request;

/**
 * 
 */
final class MessageReadRequest extends Request implements RequestWithBody
{
    /**
     * 
     */
    private string $message_id;

    /**
     * 
     */
    private string $from_phone_number_id;

    /**
     * 
     */
    public function __construct(string $message_id, string $access_token, string $from_phone_number_id, ?int $timeout = null)
    {
        $this->message_id = $message_id;
        $this->from_phone_number_id = $from_phone_number_id;

        parent::__construct($access_token, $timeout);
    }

    /**
     * Returns the raw body of the request.
     */
    public function body(): array
    {
        return [
            'messaging_product' => 'whatsapp',
            'status' => 'read',
            'message_id' => $this->message_id,
        ];
    }

    /**
     * Return WhatsApp Number Id for this request.
     */
    public function fromPhoneNumberId(): string
    {
        return $this->from_phone_number_id;
    }

    /**
     * WhatsApp node path.
     */
    public function nodePath(): string
    {
        return $this->from_phone_number_id . '/messages';
    }
}
