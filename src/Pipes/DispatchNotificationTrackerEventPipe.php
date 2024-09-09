<?php

namespace BiegalskiLLC\NotificationTracker\Pipes;

use BiegalskiLLC\NotificationTracker\Events\NotificationTrackerEmailEvent;
use BiegalskiLLC\NotificationTracker\Events\NotificationTrackerSmsEvent;
use BiegalskiLLC\NotificationTracker\Pipe;
use Closure;

/**
 * Class DispatchNotificationTrackerEventPipe
 */
class DispatchNotificationTrackerEventPipe implements Pipe
{
    /**
     * @param $content
     * @param Closure $next
     * @return mixed
     */
    public function handle($content, Closure $next): mixed
    {
        /**
         * If the DTO is null, we will not dispatch the event
         */
        if( $content['dto'] === null ) {
            return $next($content);
        }

        /**
         * If the channel is email, we will dispatch the email event
         */
        if( $content['channel'] === 'email' ) {
            NotificationTrackerEmailEvent::dispatch(
                $content['dto']
            );
        }

        /**
         * If the channel is sms, we will dispatch the sms event
         */
        if( $content['channel'] === 'sms' ) {
            NotificationTrackerSmsEvent::dispatch(
                $content['dto']
            );
        }

        return $next($content);
    }
}
