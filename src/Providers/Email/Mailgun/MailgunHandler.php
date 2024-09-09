<?php

namespace BiegalskiLLC\NotificationTracker\Providers\Email\Mailgun;

use BiegalskiLLC\NotificationTracker\DataTransferObjects\EmailData;
use BiegalskiLLC\NotificationTracker\Providers\Email\EmailHandler;
use Closure;
use Illuminate\Support\Facades\Http;

/**
 * Class MailgunHandler
 */
class MailgunHandler extends EmailHandler
{
    /**
     * @param $content
     * @param Closure $next
     * @return mixed
     */
    public function handle($content, Closure $next): mixed
    {
        parent::handle($content, $next);

        $storageUrl = $content['payload']['event-data']['storage']['url'] ?? null;
        $emailContent = null;

        if( $storageUrl !== null ){
            $emailContent = $this->getEmailContent($storageUrl);
        }

        $content['dto'] = new EmailData(
            externalId: $content['payload']['id'],
            status: $content['status'],
            subject: $content['payload']['event-data']['message']['headers']['subject'],
            recipient: $content['payload']['event-data']['recipient'],
            content: $emailContent,
            metadata: [
                'flags' => $content['payload']['event-data']['flags'] ?? null,
                'tags' => $content['payload']['event-data']['tags'] ?? null,
                'user_variables' => $content['payload']['event-data']['user-variables'] ?? null,
            ]
        );

        return $next($content);
    }

    /**
     * @param $storageUrl
     * @return array
     */
    private function getEmailContent($storageUrl): array
    {
        try{

            $response = Http::get(
                $storageUrl,
                [
                    'auth' => [
                        'api',
                        config('services.mailgun.webhook_signing_key')
                    ]
                ]
            );

            $body = $response->json();

            return [
                'stripped-text' => $body['stripped-text'],
                'stripped-html' => $body['stripped-html'],
                'body-plain' => $body['body-plain'],
                'body-html' => $body['body-html']
            ];

        }catch (\Exception $exception){
            return [];
        }
    }
}
