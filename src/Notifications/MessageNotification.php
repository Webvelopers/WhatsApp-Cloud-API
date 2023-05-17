<?php

namespace Webvelopers\WhatsAppCloudApi\Notification;

use Webvelopers\WhatsAppCloudApi\Notification;
use Webvelopers\WhatsAppCloudApi\Notification\Support\Context;
use Webvelopers\WhatsAppCloudApi\Notification\Support\Customer;
use Webvelopers\WhatsAppCloudApi\Notification\Support\Referral;

/**
 *
 */
abstract class MessageNotification extends Notification
{
    /**
     *
     */
    protected ?Context $context;

    /**
     *
     */
    protected ?Customer $customer;

    /**
     *
     */
    protected ?Referral $referral;

    /**
     *
     */
    public function customer(): ?Customer
    {
        return $this->customer;
    }

    /**
     *
     */
    public function replyingToMessageId(): ?string
    {
        if (!$this->context)
            return null;

        return $this->context->replyingToMessageId();
    }

    /**
     *
     */
    public function isForwarded(): bool
    {
        if (!$this->context)
            return false;

        return $this->context->isForwarded();
    }

    /**
     *
     */
    public function context(): ?Context
    {
        return $this->context;
    }

    /**
     *
     */
    public function referral(): ?Referral
    {
        return $this->referral;
    }

    /**
     *
     */
    public function withContext(Context $context): self
    {
        $this->context = $context;

        return $this;
    }

    /**
     *
     */
    public function withReferral(Referral $referral): self
    {
        $this->referral = $referral;

        return $this;
    }

    /**
     *
     */
    public function withCustomer(Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
