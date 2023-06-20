<?php

namespace Webvelopers\WhatsAppCloudApi\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface as Uuid;
use Webvelopers\WhatsAppCloudApi\Enums\WebhookType;
use Webvelopers\WhatsAppCloudApi\Models\VerifyToken;
use Webvelopers\WhatsAppCloudApi\Models\Webhook;
use Webvelopers\WhatsAppCloudApi\Support\Challenge;

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
            return new Response(__('whatsapp.errors.webhook.verify_token.hub'), 400);

        $webhook_id = $this->saveVerifyToken($this->saveWebhook());

        if ($webhook_id === null)
            return new Response(__('whatsapp.errors.webhook.verify_token.database'), 500);

        if ($this->hub_verify_token !== $this->verify_token)
            return new Response(Challenge::make(), 403);

        if (
            VerifyToken::where('webhook_id', $webhook_id)
            ->update(['validated_at' => now()]) === 0
        )
            return new Response(__('whatsapp.errors.webhook.verify_token.database'), 500);

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
    private function saveWebhook(): ?int
    {
        $webhook = Webhook::create([
            'type' => WebhookType::VerifyToken,
            'data' => $this->hub,
        ]);

        return $webhook->id ?? null;
    }

    /**
     * .
     */
    private function saveVerifyToken(int $webhook_id = null): ?int
    {
        if ($webhook_id === null)
            return null;

        $verify_token = VerifyToken::create([
            'webhook_id' => $webhook_id,
            'hub_challenge' => $this->hub_challenge,
            'hub_verify_token' => $this->hub_verify_token,
        ]);

        return $verify_token->webhook->id ?? null;
    }
}
