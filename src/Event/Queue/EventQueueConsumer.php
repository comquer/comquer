<?php declare(strict_types=1);

namespace Comquer\Event\Queue;

interface EventQueueConsumer
{
    public function consumeEventQueue() : void;
}
