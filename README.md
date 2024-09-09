# Notification Tracker

Notification Tracker is a Laravel package that empowers developers to seamlessly track and manage the lifecycle of user notifications. Gain valuable insights into notification status (sent, delivered, read), content, recipient interactions and more.

This package is meant to be a sensible replacement for the [Mailgun Webhooks For Laravel](https://github.com/Biegalski-LLC/Laravel-Mailgun-Webhooks) package. It is designed to be more flexible, easier to use and less opinionated.

At its core, Notification Tracker acts as a simple vehicle for ingesting notification data sent by third-party service webhooks. It then triggers a Laravel event, allowing you to listen in and do whatever you need with the notification data. This includes storing the content, updating the status, forwarding the email or SMS, and much more.

The flexibility of this approach gives you complete control over how you handle and process your notification data within your Laravel application.

## Installation

You can install the package via composer:

```bash
composer require biegalski-llc/notification-tracker
```

## Usage

```php
$notificationTracker = new BiegalskiLLC\NotificationTracker();
echo $notificationTracker->echoPhrase('Hello, BiegalskiLLC!');
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

- [Michael Biegalski](https://github.com/michael@biegalski-llc.com)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
