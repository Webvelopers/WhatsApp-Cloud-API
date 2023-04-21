<?php

namespace Webvelopers\WhatsAppCloudApi\Request;

/**
 *
 */
interface RequestWithBody
{
    /**
     * Return the headers for this request.
     */
    public function headers(): array;

    /**
     * Return the timeout for this request.
     */
    public function timeout(): int;

    /**
     * Return the headers for this request.
     */
    public function nodePath(): string;

    /**
     * Returns the raw body of the request.
     */
    public function body(): array;
}
