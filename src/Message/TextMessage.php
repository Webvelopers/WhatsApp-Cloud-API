<?php

namespace Webvelopers\WhatsAppCloudAPI\Message;

use Webvelopers\WhatsAppCloudAPI\Message as MessageBase;

final class TextMessage extends MessageBase
{
    /**
     * @const int Default Maximum length.
     */
    private const DEFAULT_MAXIMUM_LENGTH = 4096;

    /**
    * @var int The Maximum length.
    */
    protected int $maximum_length;

    /**
    * @var string The type message.
    */
    protected string $type = 'text';

    /**
     * Creates a new message of type text.
     */
    public function __construct(string $to, string $text, bool $preview_url = false, ?int $maximum_length = null)
    {
        $this->maximum_length = $maximum_length ?? self::DEFAULT_MAXIMUM_LENGTH;
        $this->validate($text);

        $this->object = [
            "preview_url" => $preview_url,
            "body" => $text,
        ];

        parent::__construct($to);
    }

    /**
     * Validates maximum length text.
     */
    private function validate(string $text): void
    {
        if (strlen($text) > $this->maximum_length) {
            throw new \LengthException(__('The maximun length for a message text is :maximum_length characters', ['maximum_length' => $this->maximum_length]));
        }
    }
}
