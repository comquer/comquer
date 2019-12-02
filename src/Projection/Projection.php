<?php declare(strict_types=1);

namespace Comquer\Projection;

use Comquer\Serialization\Deserializable;
use Comquer\Serialization\Serializable;
use DateTimeImmutable;

interface Projection extends Serializable, Deserializable
{
    public function getProjectionId() : ProjectionId;

    public static function getProjectionName() :  string;

    public function getUpdatedAt() : DateTimeImmutable;
}
