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
    case Contact = 'contact';

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
    case OptionsList = 'options-list';

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
