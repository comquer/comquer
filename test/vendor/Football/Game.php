<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football;

use Comquer\Projection\Projection;
use DateTimeImmutable;

final class Game implements Projection
{
    private const PROJECTION_NAME = 'game';

    private GameId $gameId;

    private DateTimeImmutable $startTime;

    private string $status;

    private DateTimeImmutable $updatedAt;

    public function __construct(GameId $gameId, DateTimeImmutable $startTime, string $status, DateTimeImmutable $updatedAt)
    {
        $this->gameId = $gameId;
        $this->startTime = $startTime;
        $this->status = $status;
        $this->updatedAt = $updatedAt;
    }

    public static function deserialize(array $serialized) : self
    {
        return new self();
    }

    public function getProjectionId() : GameId
    {
        return $this->gameId;
    }

    public static function getProjectionName() : string
    {
        return self::PROJECTION_NAME;
    }

    public function getUpdatedAt() : DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function serialize() : array
    {
        return [
            'gameId' => (string) $this->gameId,
            ''
        ];
    }
}