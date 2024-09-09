<?php

namespace BiegalskiLLC\NotificationTracker;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use BiegalskiLLC\NotificationTracker\Commands\NotificationTrackerCommand;

class NotificationTrackerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('notification-tracker');
    }
}
