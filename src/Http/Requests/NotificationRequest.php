<?php

namespace Webvelopers\WhatsAppCloudApi\Http\Requests;

use Illuminate\Http\JsonResponse;

final class NotificationRequest
{
    protected array $payload;

    /**
     * Instances of class.
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    /**
     * .
     */
    public function save(): JsonResponse
    {
        if (!in_array('object', $this->payload)) {
            dd('object');
            return response()->json([], 400);
        }

        if (!is_array($payload['entry'] ?? null)) {
            dd('entry');
            return response()->json([], 400);
        }

        $entry = $payload['entry'][0] ?? [];
        $id = $entry['changes'][0]['id'] ?? [];
        $contact = $entry['changes'][0]['value']['contacts'][0] ?? [];
        $errors = $entry['changes'][0]['value']['errors'][0] ?? [];
        $message = $entry['changes'][0]['value']['messages'][0] ?? [];
        $metadata = $entry['changes'][0]['value']['metadata'] ?? [];
        $status = $entry['changes'][0]['value']['statuses'][0] ?? [];

        if ($errors) {
            return response()->json($errors, 400);
        }

        if ($message) {
            return response()->json($message, 200);
        }

        if ($status) {
            return response()->json($status, 200);
        }

        return response()->json([], 400);
    }
}
