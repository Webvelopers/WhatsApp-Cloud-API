<?php

namespace Webvelopers\WhatsAppCloudApi\Support;

class Challenge
{
    static public function make(): string
    {
        return random_int(100000000, 999999999);
    }
}
