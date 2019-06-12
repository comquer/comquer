<?php declare(strict_types=1);

namespace Comquer\Event\Framework;

use Comquer\DomainIntegration\Event\AggregateId;
use Comquer\DomainIntegration\Event\Event;
use DateTimeImmutable;

abstract class FrameworkEvent implements Event
{
    /** @var AggregateId */
    private $aggregateId;

    /** @var DateTimeImmutable */
    private $occurredOn;

    public function __construct(AggregateId $aggregateId, DateTimeImmutable $occurredOn)
    {
        $this->aggregateId = $aggregateId;
        $this->occurredOn = $occurredOn;
    }

    public function getAggregateId() : AggregateId
    {
        return $this->aggregateId;
    }

    public function getOccurredOn() : DateTimeImmutable
    {
        return $this->occurredOn;
    }
}