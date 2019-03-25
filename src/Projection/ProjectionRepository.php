<?php declare(strict_types=1);

namespace Comquer\Projection;

interface ProjectionRepository
{
    public function persist(Projection $projection): void;

    public function getById(ProjectionId $id): Projection;
}