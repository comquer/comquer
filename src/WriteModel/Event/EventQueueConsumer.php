<?php declare(strict_types=1);

namespace Comquer\WriteModel\Event;

use Comquer\Persistence\Queue\QueueConsumer;
use Comquer\ReadModel\Projection\Configuration\ProjectionConfiguration;

class EventQueueConsumer
{
    private QueueConsumer $consumer;

    private ProjectionConfiguration $projectionConfiguration;

    public function __construct(QueueConsumer $consumer, ProjectionConfiguration $projectionConfiguration)
    {
        $this->consumer = $consumer;
        $this->projectionConfiguration = $projectionConfiguration;
    }

    public function __invoke() : void
    {
        foreach ()
    }
}