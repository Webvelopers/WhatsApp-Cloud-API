<?php

namespace Webvelopers\WhatsAppCloudApi\Notifications;

use Webvelopers\WhatsAppCloudApi\Enums\NotificationType;
use Webvelopers\WhatsAppCloudApi\Models\Notification as NotificationModel;

final class Notification
{
    /**
     * Notification.
     */
    protected array $notification;

    private bool $set;

    /**
     * Instances of Class.
     */
    public function __construct(array $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Sets Notification.
     */
    public function set(): bool
    {
        $this->saveModel();

        return $this->set;
    }

    /**
     * Saves notification on database.
     */
    protected function saveModel(): void
    {
        NotificationModel::create([
            'type' => NotificationType::Notification,
            'data' => $this->notification,
        ]);
    }

    protected function setMessage()
    {

    }
}
