<?php declare(strict_types=1);

namespace CQRS\Event\Queue;

use CQRS\Event\StoreId;

interface EventQueue
{
    public function queueForHandling(StoreId $eventId ): void;

    public function pullNextInLine(): StoreId;

    public function isEmpty(): bool;
}
