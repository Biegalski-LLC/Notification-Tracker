<?php

namespace BiegalskiLLC\NotificationTracker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BiegalskiLLC\NotificationTracker\NotificationTracker
 */
class NotificationTracker extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \BiegalskiLLC\NotificationTracker\NotificationTracker::class;
    }
}
