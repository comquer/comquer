<?php declare(strict_types=1);

namespace CQRS\Event\Queue;

interface EventQueue
{
    public function push(StoreId $eventId ): void;

    public function pullNext(): StoreId;

    public function isEmpty(): bool;
}
