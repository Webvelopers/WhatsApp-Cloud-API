<?php

namespace Webvelopers\WhatsAppCloudApi\Http\Requests;

use Illuminate\Http\Response;
use Webvelopers\WhatsAppCloudApi\Enums\WebhookType;
use Webvelopers\WhatsAppCloudApi\Models\Webhook;

final class WebhookRequest
{
    /**
     * Instances of class.
     */
    public function __construct()
    {
        //
    }

    /**
     * .
     */
    private function webhook(): ?int
    {
        $webhook = Webhook::create([
            'type' => WebhookType::VerifyToken,
            'data' => ,
        ]);

        return $webhook->id ?? null;
    }
}
