<?php

namespace BiegalskiLLC\NotificationTracker\DataTransferObjects;

use Illuminate\Support\Arr;

/**
 * Class SmsData
 */
class SmsData
{
    /**
     * @param string $externalId
     * @param string $status
     * @param string $recipient
     * @param string $content
     */
    public function __construct(
        public string $externalId,
        public string $status,
        public string $recipient,
        public string $content
    ) {}

    /**
     * @param array $data
     * @return SmsData
     */
    public static function fromArray(array $data): SmsData
    {
        return new self(
            externalId: Arr::get($data, 'external_id'),
            status: Arr::get($data, 'status'),
            recipient: Arr::get($data, 'recipient'),
            content: Arr::get($data, 'content'),
        );
    }
}
