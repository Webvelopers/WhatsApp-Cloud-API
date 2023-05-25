<?php

namespace Webvelopers\WhatsAppCloudApi\Support;

class Challenge
{
    /**
     * Returns challenge string like Hub Challenge by Meta.
     */
    static public function make(): string
    {
        return random_int(100000000, 999999999);
    }
}
