<?php

namespace Webvelopers\WhatsAppCloudApi\Message;

use Webvelopers\WhatsAppCloudApi\Message\Contact\ContactName;
use Webvelopers\WhatsAppCloudApi\Message\Contact\Phone;
use Webvelopers\WhatsAppCloudApi\Message\Contact\Phones;

/**
 *
 */
final class ContactMessage extends Message
{
    /**
     *
     */
    protected string $type = 'contacts';

    /**
     *
     */
    private ContactName $contact_name;

    /**
     *
     */
    private Phones $phones;

    /**
     *
     */
    public function __construct(string $phone_number, ContactName $contact_name, Phone ...$phones)
    {
        parent::__construct($phone_number);

        $this->contact_name = $contact_name;
        $this->phones = new Phones(...$phones);
    }

    /**
     *
     */
    public function fullName(): string
    {
        return $this->contact_name->fullName();
    }

    /**
     *
     */
    public function firstName(): string
    {
        return $this->contact_name->firstName();
    }

    /**
     *
     */
    public function lastName(): string
    {
        return $this->contact_name->lastName();
    }

    /**
     *
     */
    public function phones(): Phones
    {
        return $this->phones;
    }
}
