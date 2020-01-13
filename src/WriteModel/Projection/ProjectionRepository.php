<?php declare(strict_types=1);

namespace Comquer\WriteModel\Projection;

use Comquer\ReadModel\Projection\Projection;

class ProjectionRepository extends \Comquer\ReadModel\Projection\ProjectionRepository
{
    public function persist(Projection $projection) : void
    {
        $this->databaseClient->upsert(
            $projection::getProjectionName(),
            [
                'projectionId' => (string) $projection->getProjectionId(),
            ],
            $projection->serialize()
        );
    }
}