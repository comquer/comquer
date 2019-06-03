<?php declare(strict_types=1);

namespace Comquer\Event\EventListener;

use Comquer\DomainIntegration\Event\Event;
use Comquer\NamedResource;

interface EventListener extends NamedResource
{
    public function __invoke(Event $event) : void;
}