<?php declare(strict_types=1);

namespace Comquer\Event\Framework\Command;

use Comquer\DomainIntegration\Event\Event;
use Comquer\Event\AggregateId;
use DateTimeImmutable;

final class CommandHandlingSucceeded extends CommandHandlingEvent
{
    /** @var string */
    private const NAME = 'command handling succeeded';

    public function __construct(string $commandName, AggregateId $aggregateId, DateTimeImmutable $occurredOn = null)
    {
        parent::__construct(
            $commandName,
            $aggregateId,
            $occurredOn ?: new DateTimeImmutable()
        );
    }

    public function serialize() : array
    {
        return [
            'eventName' => self::getName(),
            'aggregateType' => (string) $this->getAggregateType(),
            'aggregateId' => (string) $this->getAggregateId(),
            'commandName' => $this->getCommandName(),
            'occurredOn' => $this->getOccurredOn()->getTimestamp(),
        ];
    }

    public static function deserialize(array $event) : Event
    {
        return new self(
            $event['commandName'],
            new AggregateId($event['aggregateId']),
            (new DateTimeImmutable())->setTimestamp($event['occurredOn'])
        );
    }

    public static function getName() : string
    {
        return self::NAME;
    }
}