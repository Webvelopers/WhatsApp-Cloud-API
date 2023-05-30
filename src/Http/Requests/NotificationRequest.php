<?php

namespace Webvelopers\WhatsAppCloudApi\Http\Requests;

use \DateTimeImmutable as DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

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

    protected array $payload;
    protected array $metadata;
    protected array $contact;
    protected array $errors;
    protected array $statuses;
    protected array $messages;

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
     * .
     */
    public function create(): JsonResponse
    {
        //Log::info(json_encode($this->payload, true));

        if (!$this->validate())
            return response()->json([], 400);

        $this->setPayload();

        return response()->json([
            'id' => $this->whatsapp_business_account_id,
            'metadata' => $this->metadata,
            'contact' => $this->contact,
            'errors' => $this->errors,
            'statuses' => $this->statuses,
            'messages' => $this->messages,
        ], 200);
    }

    /**
     * .
     */
    private function validate(): bool
    {
        // object
        if (!array_key_exists('object', $this->payload))
            return false;

        $object = $this->payload['object'];

        if ('whatsapp_business_account' !== $object)
            return false;

        // entry
        if (!array_key_exists('entry', $this->payload))
            return false;

        $entry = $this->payload['entry'];

        if (!is_array($entry))
            return false;

        if (!array_key_exists(0, $entry))
            return false;

        $entry = $entry[0];

        if (!is_array($entry))
            return false;

        // id
        if (!array_key_exists('id', $entry))
            return false;

        $id = $entry['id'];

        if ($this->whatsapp_business_account_id !== $id)
            return false;

        // changes
        if (!array_key_exists('changes', $entry))
            return false;

        $changes = $entry['changes'];

        if (!is_array($changes))
            return false;

        if (!array_key_exists(0, $changes))
            return false;

        $changes = $changes[0];

        if (!is_array($changes))
            return false;

        // field
        if (!array_key_exists('field', $changes))
            return false;

        $field = $changes['field'];
        if ('messages' !== $field)
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

        $entry = $this->payload['entry'][0];
        $this->metadata = $entry['changes'][0]['value']['metadata'] ?? [];
        $this->contact = $entry['changes'][0]['value']['contacts'][0] ?? [];
        $this->errors = $entry['changes'][0]['value']['errors'][0] ?? [];
        $this->statuses = $entry['changes'][0]['value']['statuses'][0] ?? [];
        $this->messages = $entry['changes'][0]['value']['messages'][0] ?? [];

        return true;
    }

    private function setPayload()
    {
        $entry = $this->payload['entry'][0];
        $this->metadata = $entry['changes'][0]['value']['metadata'] ?? [];
        $this->contact = $entry['changes'][0]['value']['contacts'][0] ?? [];
        $this->errors = $entry['changes'][0]['value']['errors'][0] ?? [];
        $this->statuses = $entry['changes'][0]['value']['statuses'][0] ?? [];
        $this->messages = $entry['changes'][0]['value']['messages'][0] ?? [];
    }
}
