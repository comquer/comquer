<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\DomainIntegration\AggregateType;

class AggregateEventsSubscription implements Subscription
{
    /** @var AggregateType */
    private $aggregateType;

    /** @var string */
    private $listenerName;

    public function __construct(AggregateType $aggregateType, string $listenerName)
    {
        $this->aggregateType = $aggregateType;
        $this->listenerName = $listenerName;
    }

    public function getAggregateType() : AggregateType
    {
        return $this->aggregateType;
    }

    public function getListenerName() : string
    {
        return $this->listenerName;
    }

    public function __toString(): string
    {
        return "{$this->getAggregateType()}{$this->getListenerName()}";
    }
}