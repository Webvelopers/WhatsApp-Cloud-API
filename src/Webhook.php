<?php

namespace Webvelopers\WhatsAppCloudAPI;

/**
 * Verify Token field configured in your app's App Dashboard.
 * @link https://developers.facebook.com/docs/graph-api/webhooks/getting-started?locale=en_US#configure-webhooks-product
 */
class WebHook
{
    /**
     * A string in the Verify Token field
     */
    protected string $verify_token;

    /**
     * Instantiates a new WebHook object.
     */
    public function __construct(string $verify_token)
    {
        $this->verify_token = $verify_token;
    }

    /**
     * Verify a webhook anytime you configure a new one in your Meta App Dashboard.
     */
    public function verify(array $payload): mixed
    {
        $hub_mode = $payload['hub_mode'] ?? null;
        $hub_verify_token = $payload['hub_verify_token'] ?? null;
        $hub_challenge = $payload['hub_challenge'] ?? '';

        if ($hub_mode !== 'subscribe' || $hub_verify_token !== $this->verify_token) {
            return false;
        }

        return $hub_challenge;
    }
}
