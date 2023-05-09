<?php

namespace Webvelopers\WhatsAppCloudApi\Message\Contact;

/**
 * Contact Name
 */
final class ContactName
{
    /**
     * First name.
     */
    private string $first_name;

    /**
     * Last name.
     */
    private string $last_name;

    /**
     * Instantiates a new Contact Name object.
     */
    public function __construct(string $first_name, string $last_name = '')
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    /**
     * Returns full name.
     */
    public function fullName(): string
    {
        return "$this->first_name $this->last_name";
    }

    /**
     * Returns First name.
     */
    public function firstName(): string
    {
        return $this->first_name;
    }

    /**
     * Returns Last name.
     */
    public function lastName(): string
    {
        return $this->last_name;
    }
}
