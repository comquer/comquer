<?php declare(strict_types=1);

namespace Comquer\ReadModel\Projection;

interface ProjectionRepository
{
    public function persist(Projection $projection) : void;

    public function get(ProjectionId $projectionId, string $projectionName) : Projection;

    public function exists(ProjectionId $id, string $projectionName) : bool;
}