<?php

namespace BiegalskiLLC\NotificationTracker\Providers\Email\Postmark;

use BiegalskiLLC\NotificationTracker\DataTransferObjects\EmailData;
use BiegalskiLLC\NotificationTracker\Providers\Email\EmailHandler;
use Closure;

/**
 * Class PostmarkHandler
 */
class PostmarkHandler extends EmailHandler
{
    /**
     * @param $content
     * @param Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($content, Closure $next): mixed
    {
        parent::handle($content, $next);

        $content['dto'] = new EmailData(
            externalId: $content['payload']['MessageID'],
            status: $content['status'],
            subject: $content['payload']['Recipient'],
            recipient: $content['payload']['event-data']['recipient'],
            content: [],
            metadata: [
                'metadata' => $content['payload']['Metadata'] ?? null,
                'tags' => $content['payload']['Tag'] ?? null
            ]
        );

        return $next($content);
    }

}
