<?php declare(strict_types=1);

namespace Comquer\Event\Framework\Command;

use Comquer\DomainIntegration\AggregateId;
use Comquer\DomainIntegration\Event\Event;

class CommandHandlingFailed extends CommandEvent
{
    public static function deserialize(array $event) : Event
    {
        // TODO: Implement deserialize() method.
    }

    public function getAggregateId() : AggregateId
    {
        // TODO: Implement getAggregateId() method.
    }

    public static function getName() : string
    {
        // TODO: Implement getName() method.
    }

    public function serialize() : array
    {
        return array_merge(
            $this->command->serialize()
        );
    }
}