<?php declare(strict_types=1);

namespace CQRS\Event\Queue;

use CQRS\Event\Store\EventId;

interface EventQueue
{
    public function push(EventId $eventId ): void;

    public function pullNext(): EventId;

    public function isEmpty(): bool;
}
