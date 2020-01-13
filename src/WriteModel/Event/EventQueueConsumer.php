<?php declare(strict_types=1);

namespace Comquer\WriteModel\Event;

use Comquer\Persistence\Queue\QueueConsumer;

class EventQueueConsumer
{
    private QueueConsumer $consumer;

    public function __construct(QueueConsumer $consumer)
    {
        $this->consumer = $consumer;
    }

    public function __invoke() : void
    {

    }
}