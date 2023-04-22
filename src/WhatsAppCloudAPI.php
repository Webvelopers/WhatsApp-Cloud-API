<?php

namespace Webvelopers\WhatsAppCloudApi;

use Webvelopers\WhatsAppCloudApi\Response\ResponseException;
use Webvelopers\WhatsAppCloudApi\Message\AudioMessage;
use Webvelopers\WhatsAppCloudApi\Message\ContactMessage;
use Webvelopers\WhatsAppCloudApi\Message\DocumentMessage;
use Webvelopers\WhatsAppCloudApi\Message\ImageMessage;
use Webvelopers\WhatsAppCloudApi\Message\LocationMessage;
use Webvelopers\WhatsAppCloudApi\Message\OptionsListMessage;
use Webvelopers\WhatsAppCloudApi\Message\TemplateMessage;
use Webvelopers\WhatsAppCloudApi\Message\TextMessage;
use Webvelopers\WhatsAppCloudApi\Message\StickerMessage;
use Webvelopers\WhatsAppCloudApi\Message\VideoMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageReadRequest;
use Webvelopers\WhatsAppCloudApi\Request\MediaRequest\DownloadMediaRequest;
use Webvelopers\WhatsAppCloudApi\Request\MediaRequest\UploadMediaRequest;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest\RequestAudioMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest\RequestContactMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest\RequestDocumentMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest\RequestImageMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest\RequestLocationMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest\RequestOptionsListMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest\RequestTemplateMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest\RequestTextMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest\RequestStickerMessage;
use Webvelopers\WhatsAppCloudApi\Request\MessageRequest\RequestVideoMessage;
use Webvelopers\WhatsAppCloudApi\Message\Contact\ContactName;
use Webvelopers\WhatsAppCloudApi\Message\Contact\Phone;
use Webvelopers\WhatsAppCloudApi\Message\Media\MediaID;
use Webvelopers\WhatsAppCloudApi\Message\OptionsList\Action;
use Webvelopers\WhatsAppCloudApi\Message\Template\Component;

/**
 *
 */
class WhatsAppCloudApi
{
    /**
     *
     */
    protected App $app;

    /**
     *
     */
    protected Client $client;

    /**
     *
     */
    protected ?int $timeout;

    /**
     * Instantiates a new WhatsAppCloudApi super-class object.
     */
    public function __construct(array $config = [])
    {
        $config = array_merge([
            'access_token' => null,
            'phone_number_id' => null,
            'graph_url' => null,
            'graph_version' => null,
            'client_handler' => null,
            'timeout' => null,
        ], $config);

        $this->app = new App($config['access_token'], $config['phone_number_id']);
        $this->client = new Client($config['graph_url'], $config['graph_version'], $config['client_handler']);
        $this->timeout = $config['timeout'];
    }

    /**
     * Sends a Whatsapp text message.
     *
     * @throws ResponseException
     */
    public function sendTextMessage(string $phone_number, string $text_message, bool $preview_url = false): Response
    {
        $message = new TextMessage($phone_number, $text_message, $preview_url);
        $request = new RequestTextMessage(
            $message,
            $this->app->accessToken(),
            $this->app->phoneNumberId(),
            $this->timeout
        );

        return $this->client->sendMessage($request);
    }

    /**
     * Sends a document uploaded to the WhatsApp Cloud servers by it Media ID or you also
     * can put any public URL of some document uploaded on Internet.
     *
     * @throws ResponseException
     */
    public function sendDocument(string $to, MediaID $document_id, string $name, ?string $caption): Response
    {
        $message = new DocumentMessage($to, $document_id, $name, $caption);
        $request = new RequestDocumentMessage(
            $message,
            $this->app->accessToken(),
            $this->app->phoneNumberId(),
            $this->timeout
        );

        return $this->client->sendMessage($request);
    }

    /**
     * Sends a message template.
     *
     * @throws ResponseException
     */
    public function sendTemplate(string $to, string $template_name, string $language = 'en_US', ?Component $components = null): Response
    {
        $message = new TemplateMessage($to, $template_name, $language, $components);
        $request = new RequestTemplateMessage(
            $message,
            $this->app->accessToken(),
            $this->app->phoneNumberId(),
            $this->timeout
        );

        return $this->client->sendMessage($request);
    }

    /**
     * Sends an audio uploaded to the WhatsApp Cloud servers by it Media ID or you also
     * can put any public URL of some audio uploaded on Internet.
     *
     * @throws ResponseException
     */
    public function sendAudio(string $to, MediaID $audio_id): Response
    {
        $message = new AudioMessage($to, $audio_id);
        $request = new RequestAudioMessage(
            $message,
            $this->app->accessToken(),
            $this->app->phoneNumberId(),
            $this->timeout
        );

        return $this->client->sendMessage($request);
    }

    /**
     * Sends an image uploaded to the WhatsApp Cloud servers by it Media ID or you also
     * can put any public URL of some image uploaded on Internet.
     *
     * @throws ResponseException
     */
    public function sendImage(string $to, MediaID $image_id, ?string $caption = ''): Response
    {
        $message = new ImageMessage($to, $image_id, $caption);
        $request = new RequestImageMessage(
            $message,
            $this->app->accessToken(),
            $this->app->phoneNumberId(),
            $this->timeout
        );

        return $this->client->sendMessage($request);
    }

    /**
     * Sends a video uploaded to the WhatsApp Cloud servers by it Media ID or you also
     * can put any public URL of some video uploaded on Internet.
     *
     * @throws ResponseException
     */
    public function sendVideo(string $to, MediaID $video_id, string $caption = ''): Response
    {
        $message = new VideoMessage($to, $video_id, $caption);
        $request = new RequestVideoMessage(
            $message,
            $this->app->accessToken(),
            $this->app->phoneNumberId(),
            $this->timeout
        );

        return $this->client->sendMessage($request);
    }

    /**
     * Sends a sticker uploaded to the WhatsApp Cloud servers by it Media ID or you also
     * can put any public URL of some sticker uploaded on Internet.
     *
     * @throws ResponseException
     */
    public function sendSticker(string $to, MediaID $sticker_id): Response
    {
        $message = new StickerMessage($to, $sticker_id);
        $request = new RequestStickerMessage(
            $message,
            $this->app->accessToken(),
            $this->app->phoneNumberId(),
            $this->timeout
        );

        return $this->client->sendMessage($request);
    }

    /**
     * Sends a location.
     *
     * @throws ResponseException
     */
    public function sendLocation(string $to, float $longitude, float $latitude, string $name = '', string $address = ''): Response
    {
        $message = new LocationMessage($to, $longitude, $latitude, $name, $address);
        $request = new RequestLocationMessage(
            $message,
            $this->app->accessToken(),
            $this->app->phoneNumberId(),
            $this->timeout
        );

        return $this->client->sendMessage($request);
    }

    /**
     * Sends a contact.
     *
     * @throws ResponseException
     */
    public function sendContact(string $to, ContactName $name, Phone ...$phone): Response
    {
        $message = new ContactMessage($to, $name, ...$phone);
        $request = new RequestContactMessage(
            $message,
            $this->app->accessToken(),
            $this->app->phoneNumberId(),
            $this->timeout
        );

        return $this->client->sendMessage($request);
    }

    /**
     *
     */
    public function sendList(string $to, string $header, string $body, string $footer, Action $action): Response
    {
        $message = new OptionsListMessage($to, $header, $body, $footer, $action);
        $request = new RequestOptionsListMessage(
            $message,
            $this->app->accessToken(),
            $this->app->phoneNumberId(),
            $this->timeout
        );

        return $this->client->sendMessage($request);
    }

    /**
     * Upload a media file (image, audio, video...) to Facebook servers.
     *
     * @throws ResponseException
     */
    public function uploadMedia(string $file_path): Response
    {
        $request = new UploadMediaRequest(
            $file_path,
            $this->app->phoneNumberId(),
            $this->app->accessToken(),
            $this->timeout
        );

        return $this->client->uploadMedia($request);
    }

    /**
     * Download a media file (image, audio, video...) from Facebook servers.
     *
     * @throws ResponseException
     */
    public function downloadMedia(string $media_id): Response
    {
        $request = new DownloadMediaRequest(
            $media_id,
            $this->app->accessToken(),
            $this->timeout
        );

        return $this->client->downloadMedia($request);
    }

    /**
     * Mark a message as read
     *
     * @throws ResponseException
     */
    public function markMessageAsRead(string $message_id): Response
    {
        $request = new MessageReadRequest(
            $message_id,
            $this->app->accessToken(),
            $this->app->phoneNumberId(),
            $this->timeout
        );

        return $this->client->sendMessage($request);
    }

    /**
     * Returns the Facebook Whatsapp Access Token.
     */
    public function accessToken(): string
    {
        return $this->app->accessToken();
    }

    /**
     * Returns the Facebook Phone Number ID.
     */
    public function phoneNumberId(): string
    {
        return $this->app->phoneNumberId();
    }

    /**
     * Returns the Graph Url.
     */
    public function graphUrl(): string
    {
        return $this->client->graphUrl();
    }

    /**
     * Returns the Graph Version.
     */
    public function graphVersion(): string
    {
        return $this->client->graphVersion();
    }
}
