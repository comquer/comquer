<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football;

use Comquer\Event\AggregateId;
use Comquer\Id;
use Comquer\Projection\ProjectionId;

class GameId extends Id implements AggregateId, ProjectionId
{
}