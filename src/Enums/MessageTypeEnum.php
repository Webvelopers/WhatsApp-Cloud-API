<?php

namespace Webvelopers\WhatsAppCloudApi\Enums;

/**
 * Message Type
 */
enum MessageTypeEnum: string
{
    /**
     *
     */
    case Audio = 'audio';

    /**
     *
     */
    case Contacts = 'contacts';

    /**
     *
     */
    case Document = 'document';

    /**
     *
     */
    case Image = 'image';

    /**
     *
     */
    case Interactive = 'interactive';

    /**
     *
     */
    case Location = 'location';

    /**
     *
     */
    case Sticker = 'sticker';

    /**
     *
     */
    case Template = 'template';

    /**
     *
     */
    case Text = 'text';

    /**
     *
     */
    case Video = 'video';
}
