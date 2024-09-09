<?php

namespace BiegalskiLLC\NotificationTracker;

use BiegalskiLLC\NotificationTracker\Pipes\DispatchNotificationTrackerEventPipe;
use BiegalskiLLC\NotificationTracker\Providers\Email\Mailgun\MailgunHandler;
use BiegalskiLLC\NotificationTracker\Providers\Sms\Twilio\TwilioHandler;
use Illuminate\Pipeline\Pipeline;

/**
 * Class NotificationTracker
 */
class NotificationTracker implements Process
{
    /**
     * @var string $channel
     */
    protected string $channel;

    /**
     * @var string $handler
     */
    protected string $handler;

    /**
     * @var array $payload
     */
    protected array $payload = [];

    /**
     * @var string|null $status
     */
    protected ?string $status = null;

    /**
     * @param string $channel
     * @return $this
     */
    public function channel(string $channel): NotificationTracker
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @return $this
     */
    public function email(): NotificationTracker
    {
        $this->channel = 'email';

        return $this;
    }

    /**
     * @param string $handler
     * @return $this
     */
    public function handler(string $handler): NotificationTracker
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * @return $this
     */
    public function mailgun(): NotificationTracker
    {
        $this->channel = 'email';
        $this->handler = MailgunHandler::class;

        return $this;
    }

    /**
     * @param array $data
     * @return NotificationTracker
     */
    public function payload(array $data): NotificationTracker
    {
        $this->payload = $data;

        return $this;
    }

    /**
     * @return $this
     */
    public function sms(): NotificationTracker
    {
        $this->channel = 'sms';

        return $this;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function status(string $status): NotificationTracker
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return $this
     */
    public function twilio(): NotificationTracker
    {
        $this->channel = 'sms';
        $this->handler = TwilioHandler::class;

        return $this;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function run(): mixed
    {
        $data = [
            'channel' => $this->channel,
            'dto' => null,
            'handler' => $this->handler,
            'payload' => $this->payload,
            'status' => $this->status ?? null,
        ];

        $this->validate($data);

        return app(Pipeline::class)
            ->send($data)
            ->through(
                [
                    $this->handler,
                    DispatchNotificationTrackerEventPipe::class,
                ]
            )
            ->then(function ($data) {
                return $data;
            });
    }

    /**
     * @param array|null $data
     * @return void
     * @throws \Exception
     */
    private function validate(?array $data): void
    {
        if( !class_exists($data['handler']) ) {
            throw new \Exception('Handler does not exist');
        }

        if( !in_array($data['channel'], ['email', 'sms']) ) {
            throw new \Exception('Channel does not exist');
        }
    }
}
