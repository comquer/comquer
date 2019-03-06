<?php declare(strict_types=1);

namespace CQRS\Event\Queue;

use CQRS\Event\Store\EventStoreId;

interface EventQueue
{
    public function push(EventStoreId $eventId ): void;

    public function pullNext(): EventStoreId;

    public function isEmpty(): bool;
}
