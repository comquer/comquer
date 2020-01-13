<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\ReadModel;

use Comquer\ReadModel\Projection\Projection;
use Comquer\Validator\ArrayValidator\ArrayValidator;
use DateTimeImmutable;

final class Game extends Projection
{
    private const PROJECTION = 'game';

    private GameId $gameId;

    private string $status;

    private DateTimeImmutable $startedAt;

    public function __construct(GameId $gameId, string $status, DateTimeImmutable $startedAt, DateTimeImmutable $lastUpdatedAt)
    {
        $this->gameId = $gameId;
        $this->startedAt = $startedAt;
        $this->status = $status;
        parent::__construct(self::PROJECTION, $gameId, $lastUpdatedAt);
    }

    public static function deserialize(array $serialized) : self
    {
        self::validateSerialized($serialized);

        return new self(
            new GameId($serialized['gameId']),
            $serialized['status'],
            (new DateTimeImmutable())->setTimestamp($serialized['startedAt']),
            (new DateTimeImmutable())->setTimestamp($serialized['lastUpdatedAt']),
        );
    }

    public static function getProjectionName() : string
    {
        return self::PROJECTION;
    }

    public function serialize() : array
    {
        return [
            'projectionName' => $this::getProjectionName(),
            'projectionId' => (string) $this->getProjectionId(),
            'gameId' => (string) $this->gameId,
            'status' => $this->status,
            'startedAt' => $this->startedAt->getTimestamp(),
            'lastUpdatedAt' => $this->getLastUpdatedAt()->getTimestamp(),
        ];
    }

    private static function validateSerialized(array $serialized) : void
    {
        ArrayValidator::validateMultipleKeysExist(
            [
                'projectionName',
                'projectionId',
                'gameId',
                'status',
                'startedAt',
                'lastUpdatedAt'
            ],
            $serialized
        );
    }
}