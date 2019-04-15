<?php declare(strict_types=1);

namespace Comquer\Event\Queue;

use Comquer\Event\Event;
use Comquer\Event\Store\EventId;

interface EventQueue
{
    public function push(Event $event): void;

    public function pullNext(): Event;

    public function isEmpty(): bool;
}
