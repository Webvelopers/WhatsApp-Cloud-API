<?php

namespace Webvelopers\WhatsAppCloudApi\Http\Requests;

/**
 *
 */
interface ClientRequest
{
    /**
     * Return the node path for the request.
     */
    public function nodePath(): string;

    /**
     * Return the headers for the request.
     */
    public function headers(): array;

    /**
     * Returns the body of the request.
     */
    public function body(): array;

    /**
     * Return the timeout for the request.
     */
    public function timeout(): int;
}
