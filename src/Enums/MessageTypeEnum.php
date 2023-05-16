<?php

namespace Webvelopers\WhatsAppCloudApi\Enums;

/**
 * Message Type
 */
enum MessageTypeEnum: string
{
    /**
     * Audio
     */
    case Audio = 'audio';

    /**
     * Contacts
     */
    case Contacts = 'contacts';

    /**
     * Document
     */
    case Document = 'document';

    /**
     * Image
     */
    case Image = 'image';

    /**
     * Inteactive
     */
    case Interactive = 'interactive';

    /**
     * Lacation
     */
    case Location = 'location';

    /**
     * Sticker
     */
    case Sticker = 'sticker';

    /**
     * Template
     */
    case Template = 'template';

    /**
     * Text
     */
    case Text = 'text';

    /**
     * Video
     */
    case Video = 'video';
}
