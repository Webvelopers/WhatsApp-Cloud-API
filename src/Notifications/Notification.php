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
        return $this->saveModel();
    }

    /**
     * Saves notification on database.
     */
    protected function saveModel(): bool
    {
        if ($this->notification['error'] !== [])
            $type = NotificationType::Error;
        if ($this->notification['status'] !== [])
            $type = NotificationType::Status;
        if ($this->notification['message'] !== [])
            $type = NotificationType::Message;

        $notification = NotificationModel::create([
            'type' => $type,
            'data' => $this->notification,
        ]);

        return $notification->wasRecentlyCreated;
    }

    protected function setMessage()
    {

    }
}
