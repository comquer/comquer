<?php declare(strict_types=1);

namespace Comquer\WriteModel\Task;

use Comquer\ReadModel\Event\Event;
use Comquer\ReadModel\Projection\ProjectionRepository;

abstract class UpdateProjection extends Task
{
    private ProjectionRepository $projectionRepository;

    abstract public function __invoke(Event $event) : void;
}