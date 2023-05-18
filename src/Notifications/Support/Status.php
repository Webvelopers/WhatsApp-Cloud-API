<?php

namespace Webvelopers\WhatsAppCloudApi\Notifications\Support;

final class Status extends \MyCLabs\Enum\Enum
{
    /**
     *
     */
    private const DELIVERED = 'delivered';

    /**
     *
     */
    private const READ = 'read';

    /**
     *
     */
    private const SENT = 'sent';

    /**
     *
     */
    private const FAILED = 'failed';
}
