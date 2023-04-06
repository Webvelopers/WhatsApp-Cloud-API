<?php

namespace Webvelopers\WhatsAppCloudAPI\Request;

interface RequestWithBody
{
    /**
     * Returns the raw body of the request.
     */
    public function body(): array;
}
