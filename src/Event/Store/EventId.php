<?php declare(strict_types=1);

namespace Comquer\Event\Store;

class EventId
{
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

