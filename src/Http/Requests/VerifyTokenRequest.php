<?php

namespace Webvelopers\WhatsAppCloudApi\Http\Requests;

use Illuminate\Http\Response;
use Webvelopers\WhatsAppCloudApi\Support\Challenge;

final class VerifyTokenRequest
{
    /**
     * @const string The name of the environment variable that contains the app access token.
     */
    public const VERIFY_TOKEN = 'WHATSAPP_CLOUD_API_VERIFY_TOKEN';

    private string $hub_verify_token;
    private string $hub_challenge;

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
        $this->verify_token = $verify_token ?? env('WHATSAPP_CLOUD_API_VERIFY_TOKEN', static::VERIFY_TOKEN);
    }

    /**
     * Validates challenge.
     */
    public function validate(array $hub): Response
    {
        if (!$this->validateHub($hub))
            return new Response(__('whatsapp.webhook.verify_token.hub_error'), 400);

        if ($this->hub_verify_token !== $this->verify_token)
            return new Response(Challenge::make(), 403);

        return new Response($this->hub_challenge, 200);
    }

    /**
     * Validates verify token hub parameters.
     */
    private function validateHub(array $hub): bool
    {
        $mode = $hub['hub_mode'] ?? null;
        $challenge = $hub['hub_challenge'] ?? null;
        $verify_token = $hub['hub_verify_token'] ?? null;

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
}
