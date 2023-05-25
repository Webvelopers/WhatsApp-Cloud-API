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
        $payload = json_decode('{
            "object": "whatsapp_business_account",
            "entry": [
                {
                    "id": "WHATSAPP_BUSINESS_ACCOUNT_ID",
                    "changes": [
                        {
                            "value": {
                                "messaging_product": "whatsapp",
                                "metadata": {
                                    "display_phone_number": "PHONE_NUMBER",
                                    "phone_number_id": "PHONE_NUMBER_ID"
                                },
                                "contacts": [
                                    {
                                        "profile": {
                                            "name": "PROFILE_NAME"
                                        },
                                        "wa_id": "PHONE_NUMBER"
                                    }
                                ],
                                "messages": [
                                    {
                                        "from": "PHONE_NUMBER",
                                        "id": "wamid.ID",
                                        "timestamp": "TIMESTAMP",
                                        "text": {
                                            "body": "MESSAGE_BODY"
                                        },
                                        "type": "text"
                                    }
                                ]
                            },
                            "field": "messages"
                        }
                    ]
                }
            ]
        }');
        dd($payload);

        if ($this->payload !== $payload)
            return response()->json([], 400);

        return response()->json([], 200);
    }
}
