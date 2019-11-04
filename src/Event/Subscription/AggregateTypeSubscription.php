<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use Comquer\Event\AggregateType;
use Comquer\Event\Event;

class AggregateTypeSubscription extends Subscription
{
    /** @var AggregateType */
    private $aggregateType;

    public function __construct(AggregateType $aggregateType, string $listenerName)
    {
        $this->aggregateType = $aggregateType;
        parent::__construct($listenerName);
    }

    public function getAggregateType() : AggregateType
    {
        return $this->aggregateType;
    }

    public function __toString() : string
    {
        return "{$this->getAggregateType()}{$this->getListenerName()}";
    }

    public function isForEvent(Event $event) : bool
    {
        return (string) $this->aggregateType === (string) $event->getAggregateType();
    }
}