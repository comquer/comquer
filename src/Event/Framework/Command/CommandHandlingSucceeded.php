<?php declare(strict_types=1);

namespace Comquer\Event\Framework\Command;

use Comquer\DomainIntegration\AggregateId;
use Comquer\DomainIntegration\Event\AggregateType;
use Comquer\DomainIntegration\Event\Event;
use Comquer\Event\Framework\FrameworkEvent;
use DateTimeImmutable;

class CommandHandlingSucceeded extends FrameworkEvent
{
    public static function deserialize(array $event): Event
    {
        // TODO: Implement deserialize() method.
    }

    public function getAggregateId(): AggregateId
    {
        // TODO: Implement getAggregateId() method.
    }

    public function getAggregateType(): AggregateType
    {
        // TODO: Implement getAggregateType() method.
    }

    public function getOccurredOn(): DateTimeImmutable
    {
        // TODO: Implement getOccurredOn() method.
    }

    public static function getName(): string
    {
        // TODO: Implement getName() method.
    }

    public function serialize(): array
    {
        // TODO: Implement serialize() method.
    }
}