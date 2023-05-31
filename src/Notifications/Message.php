<?php

namespace Webvelopers\WhatsAppCloudApi\Notifications;

use Webvelopers\WhatsAppCloudApi\Enums\MessageType;
use Webvelopers\WhatsAppCloudApi\Models\Message as MessageModel;

final class Message
{
    /**
     * Message.
     */
    protected array $message;

    /**
     * Instances of Class.
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * Saves notification on database.
     */
    protected function saveModel(): void
    {
        MessageModel::create([
            'type' => MessageType::Text,
            'data' => $this->message,
        ]);
    }
}
