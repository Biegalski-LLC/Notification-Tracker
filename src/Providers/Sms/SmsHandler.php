<?php

namespace BiegalskiLLC\NotificationTracker\Providers\Sms;

use BiegalskiLLC\NotificationTracker\Pipe;
use Closure;

/**
 * Class SmsHandler
 * @package BiegalskiLLC\NotificationTracker\Providers\Sms
 */
class SmsHandler implements Pipe
{
    /**
     * @param $content
     * @param Closure $next
     * @return mixed
     */
    public function handle($content, Closure $next): mixed
    {
        if( $content['channel'] !== 'sms' ) {
            return $next($content);
        }

        if( $content['handler'] !== self::class ) {
            return $next($content);
        }
    }
}
