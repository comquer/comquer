<?php declare(strict_types=1);

namespace Comquer\Test;

use Comquer\Event\EventStore;

interface ContainerFactory
{
    public function __invoke(EventStore $eventStore);
}