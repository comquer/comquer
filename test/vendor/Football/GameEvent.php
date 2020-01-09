<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football;

use Comquer\ReadModel\Event\AggregateType;
use Comquer\ReadModel\Event\Event;
use DateTimeImmutable;

abstract class GameEvent extends Event
{
    private $gameId;

    public function __construct(GameId $gameId, DateTimeImmutable $occurredOn = null)
    {
        parent::__construct(
            $gameId,
            new AggregateType('game'),
            $occurredOn ?: new DateTimeImmutable()
        );
    }

    public function serialize() : array
    {
        return [
            'gameId' => (string) $this->gameId,
            'aggregateId' => (string) $this->getAggregateId(),
            'aggregateType' => (string) $this->getAggregateType(),
            'occurredOn' => $this->getOccurredOn()->getTimestamp(),
        ];
    }

    public static function deserialize(array $serialized) : self
    {
        return new static(
            new GameId($serialized['gameId']),
            (new DateTimeImmutable())->setTimestamp($serialized['occurredOn'])
        );
    }
}