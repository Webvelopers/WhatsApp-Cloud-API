<?php

namespace Webvelopers\WhatsAppCloudApi\Message;

/**
 *
 */
abstract class Message
{
    /**
     *
     */
    private string $messaging_product = 'whatsapp';

    /**
     *
     */
    private string $recipient_type = 'individual';

    /**
     *
     */
    private string $phone_number;

    /**
     *
     */
    protected string $type;

    /**
     * Creates a new Message class.
     */
    public function __construct(string $phone_number)
    {
        $this->phone_number = $phone_number;
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

    /**
     * Return the WhatsApp ID or phone number for the person you want to send a message to.
     */
    public function phoneNumber(): string
    {
        return $this->phone_number;
    }

    /**
     * Return the type of message object.
     */
    public function type(): string
    {
        return $this->type;
    }
}
