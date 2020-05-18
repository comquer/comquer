<?php declare(strict_types=1);

namespace Comquer\ReadModel\Projection;

use Comquer\ReadModel\Serialization\Deserializable;
use Comquer\ReadModel\Serialization\Serializable;
use DateTimeImmutable;

abstract class Projection implements Serializable, Deserializable
{
    private string $projectionName;

    private ProjectionId $projectionId;

    private DateTimeImmutable $lastUpdatedAt;

    public function __construct(string $projectionName, ProjectionId $projectionId, DateTimeImmutable $lastUpdatedAt)
    {
        $this->projectionName = $projectionName;
        $this->projectionId = $projectionId;
        $this->lastUpdatedAt = $lastUpdatedAt;
    }

    abstract public static function getProjectionName() : string;

    public function getProjectionId() : ProjectionId
    {
        return $this->projectionId;
    }

    public function getLastUpdatedAt() : DateTimeImmutable
    {
        return $this->lastUpdatedAt;
    }
}
