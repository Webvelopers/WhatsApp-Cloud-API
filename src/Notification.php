<?php

namespace Webvelopers\WhatsAppCloudApi;

use Webvelopers\WhatsAppCloudApi\Notification\Support\Business;

/**
 *
 */
abstract class Notification
{
    /**
     *
     */
    private string $id;

    /**
     *
     */
    private Business $business;

    /**
     *
     */
    private \DateTimeImmutable $received_at;

    /**
     *
     */
    public function __construct(string $id, Business $business, string $received_at)
    {
        $this->id = $id;
        $this->business = $business;
        $this->received_at = (new \DateTimeImmutable())->setTimestamp($received_at);
    }

    /**
     *
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     *
     */
    public function businessPhoneNumberId(): string
    {
        return $this->business->phoneNumberId();
    }

    /**
     *
     */
    public function businessPhoneNumber(): string
    {
        return $this->business->phoneNumber();
    }

    /**
     *
     */
    public function receivedAt(): \DateTimeImmutable
    {
        return $this->received_at;
    }
}
