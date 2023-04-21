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
    private ContactName $name;

    /**
     * 
     */
    private Phones $phones;

    /**
     * 
     */
    public function __construct(string $to, ContactName $name, Phone ...$phones)
    {
        $this->name = $name;
        $this->phones = new Phones(...$phones);

        parent::__construct($to);
    }

    /**
     * 
     */
    public function fullName(): string
    {
        return $this->name->fullName();
    }

    /**
     * 
     */
    public function firstName(): string
    {
        return $this->name->firstName();
    }

    /**
     * 
     */
    public function lastName(): string
    {
        return $this->name->lastName();
    }

    /**
     * 
     */
    public function phones(): Phones
    {
        return $this->phones;
    }
}
