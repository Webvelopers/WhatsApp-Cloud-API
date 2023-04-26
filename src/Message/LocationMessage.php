<?php

namespace Webvelopers\WhatsAppCloudApi\Message;

use Webvelopers\WhatsAppCloudApi\Message\Error\InvalidMessage;

/**
 *
 */
final class LocationMessage extends Message
{
    /**
     *
     */
    protected string $type = 'location';

    /**
     *
     */
    private float $longitude;


    /**
     *
     */
    private float $latitude;

    /**
     * Name of the location
     */
    private ?string $name;

    /**
     *
     */
    private ?string $address;

    /**
     *
     */
    public function __construct(string $phone_number, float $longitude, float $latitude, ?string $name = '', ?string $address = '')
    {
        if ($address && !$name)
            throw new InvalidMessage(_('Name is required.'));

        parent::__construct($phone_number);

        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->name = $name;
        $this->address = $address;
    }

    /**
     *
     */
    public function longitude(): float
    {
        return $this->longitude;
    }

    /**
     *
     */
    public function latitude(): float
    {
        return $this->latitude;
    }

    /**
     *
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     *
     */
    public function address(): string
    {
        return $this->address;
    }
}
