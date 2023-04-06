<?php

namespace Webvelopers\WhatsAppCloudAPI\Message;

abstract class Message
{
    /**
     * @var string Currently only "whatsapp" value is supported.
     */
    private string $messaging_product = 'whatsapp';

    /**
     * @var string Currently only "individual" value is supported.
     */
    private string $recipient_type = 'individual';

    /**
     * @var string WhatsApp ID or phone number for the person you want to send a message to.
     */
    private string $to;

    /**
     * @var string Type of message object.
     */
    protected string $type;

    /**
     * Creates a new Message class.
     */
    public function __construct(string $to)
    {
        $this->to = $to;
    }

    /**
     * Return the WhatsApp ID or phone number for the person you want to send a message to.
     */
    public function to(): string
    {
        return $this->to;
    }

    /**
     * Return the type of message object.
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * Return the messaging product.
     */
    public function messagingProduct(): string
    {
        return $this->messaging_product;
    }

    /**
     * Return the recipient type.
     */
    public function recipientType(): string
    {
        return $this->recipient_type;
    }
}
