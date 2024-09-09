<?php

namespace BiegalskiLLC\NotificationTracker\Events;

use BiegalskiLLC\NotificationTracker\DataTransferObjects\SmsData;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class NotificationTrackSmsEvent
 */
class NotificationTrackerSmsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var SmsData $smsData
     */
    public SmsData $smsData;

    /**
     * @param SmsData $smsData
     */
    public function __construct(SmsData $smsData)
    {
        $this->smsData = $smsData;
    }
}
