<?php declare(strict_types=1);

namespace Comquer\Queue;

interface EventListenerQueue
{
    public function push(EventListenerQueueElement $binding);

    public function pullNext(): EventListenerQueueElement;

    public function isEmpty(): bool;
}