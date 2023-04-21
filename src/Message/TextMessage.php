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
    private string $text;

    /**
     *
     */
    private bool $preview_url;

    /**
     * Creates a new message of type text.
     */
    public function __construct(string $to, string $text, bool $preview_url = false)
    {
        $this->assertTextIsValid($text);

        $this->text = $text;
        $this->preview_url = $preview_url;

        parent::__construct($to);
    }

    /**
     * Return the body of the text message.
     */
    public function text(): string
    {
        return $this->text;
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
        if (strlen($text) > self::MAXIMUM_LENGTH)
            throw new \LengthException(__('whatsapp.maximum_length', ['value' => self::MAXIMUM_LENGTH]));
    }
}
