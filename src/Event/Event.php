<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\DomainIntegration\Event\AggregateId;
use Comquer\DomainIntegration\Event\AggregateType;
use DateTimeImmutable;

abstract class Event
{
    private $aggregateId;

    private $aggregateType;

    private $occurredOn;

    public function __construct(AggregateId $aggregateId, AggregateType $aggregateType, ?DateTimeImmutable $occurredOn)
    {
        $this->aggregateId = $aggregateId;
        $this->aggregateType = $aggregateType;
        $this->occurredOn = $occurredOn ?: new DateTimeImmutable();
    }

    public function getAggregateId() : AggregateId
    {
        return $this->aggregateId;
    }

    public function getAggregateType() : AggregateType
    {
        return $this->aggregateType;
    }

    public function getOccurredOn() : DateTimeImmutable
    {
        return $this->occurredOn;
    }

    public function __toString() : string
    {
        return $this::getName();
    }
}