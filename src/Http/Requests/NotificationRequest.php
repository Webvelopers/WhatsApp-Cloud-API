<?php

namespace Webvelopers\WhatsAppCloudApi\Http\Requests;

use \DateTimeImmutable as DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Webvelopers\WhatsAppCloudApi\Enums\WebhookType;
use Webvelopers\WhatsAppCloudApi\Models\Webhook as WebhookModel;
use Webvelopers\WhatsAppCloudApi\Notifications\Notification;

final class NotificationRequest
{
    /**
     * WhatsApp Business Account ID.
     */
    protected string $whatsapp_business_account_id;

    /**
     * Phone Number ID.
     */
    protected string $phone_number_id;

    /**
     * Notification Payload.
     */
    protected array $payload;

    /**
     * Instances of class.
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;

        $this->whatsapp_business_account_id = env('WHATSAPP_CLOUD_API_BUSINESS_ACCOUNT_ID');
        $this->phone_number_id = env('WHATSAPP_CLOUD_API_PHONE_NUMBER_ID');
    }

    /**
     * Creates Notification.
     */
    public function create(): JsonResponse
    {
        //Log::info(json_encode($this->payload, true));

        if (!$this->validate())
            return response()->json(['error' => __('Invalid payload')], 400);

        if (!$this->setWebhook())
            return response()->json(['error' => __('Invalid saved webhook on database')], 400);

        if (!$this->setNotification())
            return response()->json(['error' => __('Invalid notification')], 400);

        return response()->json(['message' => __('Ok')], 200);
    }

    /**
     * Validates Notification.
     */
    private function validate(): bool
    {
        // object
        if (!array_key_exists('object', $this->payload))
            return false;
        if ('whatsapp_business_account' !== $this->payload['object'])
            return false;

        // entry
        if (!array_key_exists('entry', $this->payload))
            return false;
        if (!is_array($this->payload['entry']))
            return false;
        if (!array_key_exists(0, $this->payload['entry']))
            return false;
        if (!is_array($this->payload['entry'][0]))
            return false;

        // id
        if (!array_key_exists('id', $this->payload['entry'][0]))
            return false;
        if ($this->whatsapp_business_account_id !== $this->payload['entry'][0]['id'])
            return false;

        // changes
        if (!array_key_exists('changes', $this->payload['entry'][0]))
            return false;
        if (!is_array($this->payload['entry'][0]['changes']))
            return false;
        if (!array_key_exists(0, $this->payload['entry'][0]['changes']))
            return false;
        if (!is_array($this->payload['entry'][0]['changes'][0]))
            return false;

        // field
        if (!array_key_exists('field', $this->payload['entry'][0]['changes'][0]))
            return false;
        if ('messages' !== $this->payload['entry'][0]['changes'][0]['field'])
            return false;

        // value
        if (!array_key_exists('value', $this->payload['entry'][0]['changes'][0]))
            return false;
        if (!is_array($this->payload['entry'][0]['changes'][0]['value']))
            return false;

        // messaging_product
        if (!array_key_exists('messaging_product', $this->payload['entry'][0]['changes'][0]['value']))
            return false;
        if ('whatsapp' !== $this->payload['entry'][0]['changes'][0]['value']['messaging_product'])
            return false;

        // metadata
        if (!array_key_exists('metadata', $this->payload['entry'][0]['changes'][0]['value']))
            return false;
        if (!is_array($this->payload['entry'][0]['changes'][0]['value']['metadata']))
            return false;

        // display_phone_number
        if (!array_key_exists('display_phone_number', $this->payload['entry'][0]['changes'][0]['value']['metadata']))
            return false;

        // phone_number_id
        if (!array_key_exists('phone_number_id', $this->payload['entry'][0]['changes'][0]['value']['metadata']))
            return false;
        if ($this->phone_number_id !== $this->payload['entry'][0]['changes'][0]['value']['metadata']['phone_number_id'])
            return false;

        return true;
    }


    /**
     *
     */
    private function setWebhook(): bool
    {
        $webhook = WebhookModel::create([
            'type' => WebhookType::Notification,
            'data' => $this->payload,
        ]);

        return $webhook->wasRecentlyCreated;
    }

    /**
     * Sets Notification.
     */
    private function setNotification(): bool
    {
        return (new Notification([
            'id' => $this->whatsapp_business_account_id,
            'metadata' => $this->payload['entry'][0]['changes'][0]['value']['metadata'],
            'contact' => $this->payload['entry'][0]['changes'][0]['value']['contacts'][0] ?? [],
            'errors' => $this->payload['entry'][0]['changes'][0]['value']['errors'][0] ?? [],
            'statuses' => $this->payload['entry'][0]['changes'][0]['value']['statuses'][0] ?? [],
            'messages' => $this->payload['entry'][0]['changes'][0]['value']['messages'][0] ?? [],
        ]))->set();
    }
}
