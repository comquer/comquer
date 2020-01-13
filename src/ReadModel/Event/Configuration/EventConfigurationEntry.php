<?php declare(strict_types=1);

namespace Comquer\ReadModel\Event\Configuration;

use Comquer\Reflection\ClassName\ClassName;
use Comquer\Reflection\ClassName\ClassNameCollection;

class EventConfigurationEntry
{
    private ClassName $event;

    private ClassNameCollection $projections;

    public function __construct(ClassName $event, ClassNameCollection $projections)
    {
        $this->event = $event;
        $this->projections = $projections;
    }

    public function getEvent() : ClassName
    {
        return $this->event;
    }

    public function getProjections() : ClassNameCollection
    {
        return $this->projections;
    }
}