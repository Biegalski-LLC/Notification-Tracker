<?php

namespace BiegalskiLLC\NotificationTracker\DataTransferObjects;

use Illuminate\Support\Arr;

/**
 * Class EmailData
 */
class EmailData
{
    /**
     * @param string $externalId
     * @param string $status
     * @param string $subject
     * @param string $recipient
     * @param array|null $content
     * @param array|null $metadata
     */
    public function __construct(
        public string $externalId,
        public string $status,
        public string $subject,
        public string $recipient,
        public ?array $content = [],
        public ?array $metadata = [],
    ) {}

    /**
     * @param array $data
     * @return EmailData
     */
    public static function fromArray(array $data): EmailData
    {
        return new self(
            externalId: Arr::get($data, 'external_id'),
            status: Arr::get($data, 'status'),
            subject: Arr::get($data, 'subject'),
            recipient: Arr::get($data, 'recipient'),
            content: Arr::get($data, 'content') ?? [],
            metadata: Arr::get($data, 'metadata') ?? [],
        );
    }
}
