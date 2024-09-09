<?php

namespace BiegalskiLLC\NotificationTracker\Events;

use BiegalskiLLC\NotificationTracker\DataTransferObjects\EmailData;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class NotificationTrackerEmailEvent
 */
class NotificationTrackerEmailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var EmailData $emailData
     */
    public EmailData $emailData;

    /**
     * @param EmailData $emailData
     */
    public function __construct(EmailData $emailData)
    {
        $this->emailData = $emailData;
    }
}
