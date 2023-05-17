<?php

namespace Webvelopers\WhatsAppCloudApi\Messages;

/**
 *
 */
abstract class Message
{
    /**
     * Messaging Product.
     */
    private string $messaging_product = 'whatsapp';

    /**
     * Recipient Type.
     */
    private string $recipient_type = 'individual';

    /**
     * Type of message.
     */
    protected string $type;

    /**
     * Phone Number to send.
     */
    protected string $to;

    /**
     * Creates a new Message class.
     */
    public function __construct(string $to)
    {
        $this->to = $to;
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
     * Return the type of message object.
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * Return the WhatsApp ID or phone number for the person you want to send a message to.
     */
    public function to(): string
    {
        return $this->to;
    }
}
