<?php declare(strict_types=1);

namespace Comquer\ReadModel\Projection\Configuration;

use Comquer\Reflection\ClassName\ClassName;
use Comquer\Reflection\ClassName\ClassNameCollection;

class ProjectionConfigurationEntry
{
    private ClassName $projection;

    private ClassNameCollection $events;

    public function __construct(ClassName $projection, ClassNameCollection $events)
    {
        $this->projection = $projection;
        $this->events = $events;
    }

    public function getProjection() : ClassName
    {
        return $this->projection;
    }

    public function getEvents() : ClassNameCollection
    {
        return $this->events;
    }
}
