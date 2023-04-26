<?php

namespace Webvelopers\WhatsAppCloudApi\Enums;

/**
 *
 */
enum MessageTypeEnum: string
{
    /**
     *
     */
    case AUDIO = 'audio';

    /**
     *
     */
    case CONTACT = 'contact';

    /**
     *
     */
    case DOCUMENT = 'document';

    /**
     *
     */
    case IMAGE = 'image';

    /**
     *
     */
    case OPTIONS_LIST = 'options-list';

    /**
     *
     */
    case STICKER = 'sticker';

    /**
     *
     */
    case TEMPLATE = 'template';

    /**
     *
     */
    case TEXT = 'text';

    /**
     *
     */
    case VIDEO = 'video';
}
