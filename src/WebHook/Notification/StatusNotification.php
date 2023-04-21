<?php

namespace Webvelopers\WhatsAppCloudApi\WebHook\Notification;

use Webvelopers\WhatsAppCloudApi\WebHook\Notification;
use Webvelopers\WhatsAppCloudApi\WebHook\Notification\Support\Business;
use Webvelopers\WhatsAppCloudApi\WebHook\Notification\Support\Conversation;
use Webvelopers\WhatsAppCloudApi\WebHook\Notification\Support\Error;
use Webvelopers\WhatsAppCloudApi\WebHook\Notification\Support\Status;

/**
 * 
 */
final class StatusNotification extends Notification
{
    /**
     * 
     */
    private ?Conversation $conversation = null;

    /**
     * 
     */
    private string $customer_id;

    /**
     * 
     */
    private Status $status;

    /**
     * 
     */
    private ?Error $error = null;

    /**
     * 
     */
    public function __construct(
        string $id,
        Business $business,
        string $customer_id,
        string $status,
        string $received_at
    ) {
        parent::__construct($id, $business, $received_at);

        $this->customer_id = $customer_id;
        $this->status = new Status($status);
    }

    /**
     * 
     */
    public function withConversation(Conversation $conversation): self
    {
        $this->conversation = $conversation;

        return $this;
    }

    /**
     * 
     */
    public function withError(Error $error): self
    {
        $this->error = $error;

        return $this;
    }

    /**
     * 
     */
    public function customerId(): string
    {
        return $this->customer_id;
    }

    /**
     * 
     */
    public function conversationId(): ?string
    {
        if (!$this->conversation)
            return null;

        return $this->conversation->id();
    }

    /**
     * 
     */
    public function conversationType(): ?string
    {
        if (!$this->conversation)
            return null;

        return (string) $this->conversation->type();
    }

    /**
     * 
     */
    public function conversationExpiresAt(): ?\DateTimeImmutable
    {
        if (!$this->conversation)
            return null;

        return $this->conversation->expiresAt();
    }

    /**
     * 
     */
    public function isBusinessInitiatedConversation(): ?bool
    {
        if (!$this->conversation)
            return null;

        return $this->conversation->isBusinessInitiated();
    }

    /**
     * 
     */
    public function isCustomerInitiatedConversation(): ?bool
    {
        if (!$this->conversation)
            return null;

        return $this->conversation->isCustomerInitiated();
    }

    /**
     * 
     */
    public function isReferralInitiatedConversation(): ?bool
    {
        if (!$this->conversation)
            return null;

        return $this->conversation->isReferralInitiated();
    }

    /**
     * 
     */
    public function status(): string
    {
        return (string) $this->status;
    }

    /**
     * 
     */
    public function isMessageRead(): bool
    {
        return $this->status->equals(Status::READ());
    }

    /**
     * 
     */
    public function isMessageDelivered(): bool
    {
        return $this->isMessageRead() || $this->status->equals(Status::DELIVERED());
    }

    /**
     * 
     */
    public function isMessageSent(): bool
    {
        return $this->isMessageDelivered() || $this->status->equals(Status::SENT());
    }

    /**
     * 
     */
    public function hasErrors(): bool
    {
        return null !== $this->error;
    }

    /**
     * 
     */
    public function errorCode(): ?int
    {
        if (!$this->error)
            return null;

        return $this->error->code();
    }

    /**
     * 
     */
    public function errorTitle(): ?string
    {
        if (!$this->error)
            return null;

        return $this->error->title();
    }
}
