<?php declare(strict_types=1);

namespace Comquer\Event\Queue;

use Comquer\Event\Store\EventId;

interface EventQueue
{
    public function push(EventId $eventId ): void;

    public function pullNext(): EventId;

    public function isEmpty(): bool;
}
