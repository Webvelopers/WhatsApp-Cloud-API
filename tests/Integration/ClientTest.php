<?php

namespace Webvelopers\WhatsAppCloudApi\Tests\Integration;

use Webvelopers\WhatsAppCloudApi\Client;
use Webvelopers\WhatsAppCloudApi\Message\TextMessage;
use Webvelopers\WhatsAppCloudApi\Request;
use Webvelopers\WhatsAppCloudApi\Tests\WhatsAppCloudApiTestConfiguration;
use Webvelopers\WhatsAppCloudApi\WhatsAppCloudApi;
use PHPUnit\Framework\TestCase;

/**
 * @group integration
 */
final class ClientTest extends TestCase
{
    private $client;

    public function setUp(): void
    {
        $this->client = new Client(WhatsAppCloudApi::DEFAULT_GRAPH_VERSION);
    }

    public function test_send_text_message()
    {
        $message = new TextMessage(
            WhatsAppCloudApiTestConfiguration::$to_phone_number_id,
            'Hey there! I\'m using WhatsApp Cloud API. Visit https://www.Webvelopers.es',
            true
        );
        $request = new Request\MessageRequest\RequestTextMessage(
            $message,
            WhatsAppCloudApiTestConfiguration::$access_token,
            WhatsAppCloudApiTestConfiguration::$from_phone_number_id
        );

        $response = $this->client->sendMessage($request);

        $this->assertEquals(200, $response->httpStatusCode());
        $this->assertEquals($request, $response->request());
        $this->assertEquals(false, $response->isError());
    }

    public function test_upload_media()
    {
        $request = new Request\MediaRequest\UploadMediaRequest(
            'tests/Support/Webvelopers.png',
            WhatsAppCloudApiTestConfiguration::$from_phone_number_id,
            WhatsAppCloudApiTestConfiguration::$access_token
        );

        $response = $this->client->uploadMedia($request);

        $this->assertEquals(200, $response->httpStatusCode());
        $this->assertEquals($request, $response->request());
        $this->assertEquals(false, $response->isError());
        $this->assertArrayHasKey('id', $response->decodedBody());

        return $response->decodedBody()['id'];
    }

    /**
     * @depends test_upload_media
     */
    public function test_download_media(string $media_id)
    {
        $request = new Request\MediaRequest\DownloadMediaRequest(
            $media_id,
            WhatsAppCloudApiTestConfiguration::$access_token
        );

        $response = $this->client->downloadMedia($request);

        $this->assertEquals(200, $response->httpStatusCode());
        $this->assertEquals($request, $response->request());
        $this->assertEquals(false, $response->isError());
    }
}
