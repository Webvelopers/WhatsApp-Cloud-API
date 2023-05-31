<?php

namespace Webvelopers\WhatsAppCloudApi\Http\Requests;

use Illuminate\Http\Response;
use Webvelopers\WhatsAppCloudApi\Support\Challenge;
use Webvelopers\WhatsAppCloudApi\Models\Webhook;
use Webvelopers\WhatsAppCloudApi\Enums\WebhookType;

final class VerifyTokenRequest
{
    private string $hub_verify_token;
    private string $hub_challenge;

    /**
     * Hub sent by Meta.
     */
    private array $hub;

    /**
     * Verify Token field saved on App environment and configured in your app's App Dashboard.
     * @link https://developers.facebook.com/docs/graph-api/Webhooks/getting-started?locale=en_US#configure-Webhooks-product
     */
    private string $verify_token;

    /**
     * Instances of class.
     */
    public function __construct(?string $verify_token = null)
    {
        $this->verify_token = $verify_token ?? env('WHATSAPP_CLOUD_API_VERIFY_TOKEN');
    }

    /**
     * Validates challenge.
     */
    public function validate(array $hub): Response
    {
        $this->hub = $hub;

        if (!$this->validateHub())
            return new Response(__('whatsapp.webhook.verify_token.hub_error'), 400);

        if ($this->hub_verify_token !== $this->verify_token)
            return new Response(Challenge::make(), 403);

        $this->saveWebhook();

        return new Response($this->hub_challenge, 200);
    }

    /**
     * Validates verify token hub parameters.
     */
    private function validateHub(): bool
    {
        $mode = $this->hub['hub_mode'] ?? null;
        $challenge = $this->hub['hub_challenge'] ?? null;
        $verify_token = $this->hub['hub_verify_token'] ?? null;

        if ($mode !== 'subscribe' || $mode === null || $challenge === null || $verify_token === null)
            return false;

        $this->setHub($challenge, $verify_token);
        return true;
    }

    /**
     * Sets verify token hub parameters.
     */
    private function setHub(string $challenge, string $verify_token): void
    {
        $this->hub_challenge = $challenge;
        $this->hub_verify_token = $verify_token;
    }

    /**
     * .
     */
    private function saveWebhook(): void
    {
        Webhook::create([
            'type' => WebhookType::VerifyToken,
            'data' => $this->hub,
        ]);
    }
}
