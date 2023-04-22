<?php

namespace Webvelopers\WhatsAppCloudApi\Message;

/**
 *
 */
final class TextMessage extends Message
{
    /**
     * @const int Maximum length for body message.
     */
    private const MAXIMUM_LENGTH = 4096;

    /**
     *
     */
    protected string $type = 'text';

    /**
     *
     */
    private string $text_message;

    /**
     *
     */
    private bool $preview_url;

    /**
     * Creates a new message of type text.
     */
    public function __construct(string $phone_number, string $text_message, bool $preview_url = false)
    {
        $this->assertTextIsValid($text_message);

        $this->text_message = $text_message;
        $this->preview_url = $preview_url;

        parent::__construct($phone_number);
    }

    /**
     * Return the body of the text message.
     */
    public function textMessage(): string
    {
        return $this->text_message;
    }

    /**
     * Return if preview box for URLs contained in the text message is shown.
     */
    public function previewUrl(): bool
    {
        return $this->preview_url;
    }

    /**
     *
     */
    private function assertTextIsValid(string $text): void
    {
        $maximum_length = env('WHATSAPP_CLOUD_API_MAXIMUM_LENGTH', static::MAXIMUM_LENGTH);
        if (strlen($text) > $maximum_length)
            throw new \LengthException(__('whatsapp.maximum_length', ['value' => $maximum_length]));
    }
}
