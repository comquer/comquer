<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football;

use Comquer\ReadModel\Event\AggregateId;
use Comquer\Id;
use Comquer\ReadModel\Projection\ProjectionId;

class GameId extends Id implements AggregateId, ProjectionId
{
}