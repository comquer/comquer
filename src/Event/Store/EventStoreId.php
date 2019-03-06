<?php declare(strict_types=1);

namespace CQRS\Event\Store;

class EventStoreId
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(self $storeId): bool
    {
        return (string) $this === (string) $storeId;
    }
}

