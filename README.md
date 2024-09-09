# Notification Tracker

Notification Tracker is a Laravel package that empowers developers to seamlessly track and manage the lifecycle of user notifications. Gain valuable insights into notification status (sent, delivered, read), content, recipient interactions and more.

This package is meant to be a sensible replacement for the [Mailgun Webhooks For Laravel](https://github.com/Biegalski-LLC/Laravel-Mailgun-Webhooks) package. It is designed to be more flexible, easier to use and less opinionated. The goal is to also target many notification services, rather than a single service.

Every project has different needs. At its core, Notification Tracker acts as a simple vehicle for ingesting notification data sent by third-party service webhooks. It then triggers a Laravel event, allowing you to listen in and do whatever you need with the notification data. This includes storing the content, updating the status, forwarding the email or SMS, and much more.

The flexibility of this approach gives you complete control over how you handle and process your notification data within your Laravel application.

## Installation

You can install the package via composer:

```bash
composer require biegalski-llc/notification-tracker
```

## Configuration

#### Mailgun
In order to track Mailgun notifications, you will need to add the following to your `config/services.php` file.

```php  
'mailgun' => [
    'webhook_signing_key' => env('MAILGUN_WEBHOOKS_SIGNING_KEY', null)
],
```

Additionally, you'll need to utilize the following middleware for your Mailgun webhook route.

```php
BiegalskiLLC\NotificationTracker\Providers\Email\Mailgun\Middleware\ValidateMailgunWebhookMiddleware::class
```

## Usage

```php
$notificationTracker = new BiegalskiLLC\NotificationTracker();
```

#### Mailgun
```php
$notificationTracker->mailgun()
    ->payload( $request->all() )
    ->status('delivered') //change to specific webhook status
    ->run();
```

#### Postmark
```php
$notificationTracker->postmark()
    ->payload( $request->all() )
    ->status('delivered') //change to specific webhook status
    ->run();
```

#### Custom Handler
Pass your own custom handler in. Reference existing handlers for examples.
```php
use App\Handlers\CustomHandler;

$notificationTracker->email()
    ->handler( CustomHandler::class )
    ->payload( $request->all() )
    ->status('delivered') //change to specific webhook status
    ->run();
```

## Events/Listeners
When the notification tracker is run, it will trigger an event containing the notification content and details. You can listen for this event and do whatever you need with the notification data.

Store the notification content, update the delivery status, forward an email or SMS, or anything else you can think of.

#### NotificationTrackerEmailEvent
```php
namespace App\Listeners;

use BiegalskiLLC\NotificationTracker\Events\NotificationTrackerEmailEvent;

class NotificationTrackerEmailListener
{
    public function handle(NotificationTrackerEmailEvent $event)
    {
        //do something with the notification data
    }
}
```

#### NotificationTrackerSmsEvent
```php
namespace App\Listeners;

use BiegalskiLLC\NotificationTracker\Events\NotificationTrackerSmsEvent;

class NotificationTrackerSmsListener
{
    public function handle(NotificationTrackerSmsEvent $event)
    {
        //do something with the notification data
    }
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Michael Biegalski](https://github.com/Biegalski-LLC)
- [paulredmond](https://gist.github.com/paulredmond/14523d3bd8062f9ce48cdd1340b3f171) - Laravel Middleware to Validate a signed Mailgun Webhook.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
