<?php declare(strict_types=1);

namespace Comquer\Event\Framework\Command;

use Comquer\DomainIntegration\Event\Event;
use Comquer\Event\AggregateId;
use Comquer\Exception\FrameworkException;
use DateTimeImmutable;

final class CommandHandlingFailed extends CommandHandlingEvent
{
    /** @var string */
    private const NAME = 'command handling failed';

    /** @var FrameworkException */
    private $exception;

    public function __construct(
        FrameworkException $exception,
        string $commandName,
        AggregateId $aggregateId,
        DateTimeImmutable $occurredOn = null
    ) {
        $this->exception = $exception;
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
            'exception' => $this->exception->serialize()
        ];
    }

    public static function deserialize(array $event) : Event
    {
        return new self(
            $event['exception']::deserialize(),
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