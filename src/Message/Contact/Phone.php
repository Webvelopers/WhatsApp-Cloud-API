<?php

namespace Webvelopers\WhatsAppCloudApi\Message\Contact;

/**
 *
 */
final class Phone
{
    /**
     *
     */
    private string $number;

    /**
     *
     */
    private PhoneType $type;

    /**
     *
     */
    private string $wa_id;

    /**
     *
     */
    public function __construct(string $number, PhoneType $type, string $wa_id = '')
    {
        $this->number = $number;
        $this->type = $type;
        $this->wa_id = $wa_id;
    }

    /**
     *
     */
    public function number(): string
    {
        return $this->number;
    }

    /**
     *
     */
    public function type(): PhoneType
    {
        return $this->type;
    }

    /**
     *
     */
    public function waId(): string
    {
        return $this->wa_id;
    }
}
