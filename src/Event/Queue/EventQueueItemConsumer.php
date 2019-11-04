<?php declare(strict_types=1);

namespace Comquer\Event\Queue;

interface EventQueueItemConsumer
{
    public function consume(EventQueueItem $eventQueueItem) : void;
}
