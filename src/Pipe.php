<?php

namespace BiegalskiLLC\NotificationTracker;

use Closure;

/**
 * Interface Pipe
 */
interface Pipe
{
    /**
     * @param $content
     * @param Closure $next
     * @return mixed
     */
    public function handle($content, Closure $next): mixed;
}
