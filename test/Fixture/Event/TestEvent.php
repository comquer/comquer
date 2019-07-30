<?php declare(strict_types=1);

namespace ComquerTest\Fixture\Event;

use Comquer\DomainIntegration\Event\AggregateId;
use Comquer\DomainIntegration\Event\Event;
use DateTimeImmutable;

abstract class TestEvent implements Event
{
    public static function deserialize(array $event) : Event
    {
        return new static();
    }

    public function getAggregateId() : AggregateId
    {
        return new class implements AggregateId {
            public function __toString() : string
            {
                return uniqid('aggregate_id_');
            }
        };
    }

    public function getOccurredOn() : DateTimeImmutable
    {
        return new DateTimeImmutable();
    }

    public function serialize(): array
    {
        return [];
    }
}