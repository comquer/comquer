<?php declare(strict_types=1);

namespace Comquer\ReadModel\Projection;

use Comquer\ReadModel\Serialization\Deserializable;
use Comquer\ReadModel\Serialization\Serializable;
use DateTimeImmutable;

interface Projection extends Serializable, Deserializable
{
    public function getProjectionId() : ProjectionId;

    public static function getProjectionName() :  string;

    public function getUpdatedAt() : DateTimeImmutable;
}
