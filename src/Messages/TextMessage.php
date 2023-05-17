<?php

namespace Webvelopers\WhatsAppCloudApi\Messages;

/**
 * Text Message
 */
final class TextMessage extends Message
{
    /**
     * @const int Maximum length for body message.
     */
    private const MAXIMUM_LENGTH = 4096;

    /**
     * Type of message.
     */
    protected string $type = 'text';

    /**
     * Text message body.
     */
    private string $body;

    /**
     * Preview URL.
     */
    private ?bool $preview_url;

    /**
     * Creates a new message of type text.
     */
    public function __construct(string $to, string $body, ?bool $preview_url = false)
    {
        $this->validateBody($body);

        $this->body = $body;
        $this->preview_url = $preview_url;

        parent::__construct($to);
    }

    /**
     * Return the body of the text message.
     */
    public function body(): string
    {
        return $this->body;
    }

    /**
     * Return if preview box for URLs contained in the text message is shown.
     */
    public function previewUrl(): bool
    {
        return $this->preview_url;
    }

    /**
     * Validate maximum length of body text message.
     */
    private function validateBody(string $body): void
    {
        $maximum_length = env('WHATSAPP_CLOUD_API_MAXIMUM_LENGTH', static::MAXIMUM_LENGTH);
        if (strlen($body) > $maximum_length)
            throw new \LengthException(__('whatsapp.maximum_length', ['value' => $maximum_length]));
    }
}
