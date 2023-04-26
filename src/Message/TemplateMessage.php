<?php

namespace Webvelopers\WhatsAppCloudApi\Message;

use Webvelopers\WhatsAppCloudApi\Message\Template\Component;

/**
 *
 */
final class TemplateMessage extends Message
{
    /**
     *
     */
    protected string $type = 'template';

    /**
     * Name of the template
     */
    private string $name;

    /**
     *
     */
    private ?string $language;

    /**
     * Templates header, body and buttons can be personalized
     */
    private ?Component $components;

    /**
     *
     */
    public function __construct(string $phone_number, string $name, ?string $language = 'en_US', ?Component $components = null)
    {
        parent::__construct($phone_number);

        $this->name = $name;
        $this->language = $language;
        $this->components = $components;
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
    public function language(): string
    {
        return $this->language;
    }

    /**
     *
     */
    public function header(): array
    {
        return $this->components ? $this->components->header() : [];
    }

    /**
     *
     */
    public function body(): array
    {
        return $this->components ? $this->components->body() : [];
    }

    /**
     *
     */
    public function buttons(): array
    {
        return $this->components ? $this->components->buttons() : [];
    }
}
