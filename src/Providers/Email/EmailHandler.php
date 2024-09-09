<?php

namespace BiegalskiLLC\NotificationTracker\Providers\Email;

use BiegalskiLLC\NotificationTracker\Pipe;
use Closure;

/**
 * Class EmailHandler
 * @package BiegalskiLLC\NotificationTracker\Providers\Email
 */
class EmailHandler implements Pipe
{
    /**
     * @param $content
     * @param Closure $next
     * @return mixed
     */
    public function handle($content, Closure $next): mixed
    {
        if( $content['channel'] !== 'email' ) {
            return $next($content);
        }

        if( $content['handler'] !== self::class ) {
            return $next($content);
        }
    }
}
