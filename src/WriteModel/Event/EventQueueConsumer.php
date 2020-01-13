<?php declare(strict_types=1);

namespace Comquer\WriteModel\Event;

use Comquer\Persistence\Queue\QueueConsumer;
use Comquer\ReadModel\Projection\Configuration\ProjectionConfiguration;

class EventQueueConsumer
{
    private QueueConsumer $queueConsumer;

    private ProjectionConfiguration $projectionConfiguration;

    public function __construct(QueueConsumer $queueConsumer, ProjectionConfiguration $projectionConfiguration)
    {
        $this->queueConsumer = $queueConsumer;
        $this->projectionConfiguration = $projectionConfiguration;
    }

    public function __invoke() : void
    {
        ($this->queueConsumer)('events', function (array $event) {
            
            $this->projectionConfiguration->getProjectionsByEventName();
        });
    }
}