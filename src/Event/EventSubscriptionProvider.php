<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\DomainIntegration\Event\Event;

interface EventSubscriptionProvider
{
    public function getForEvent(Event $event) : EventSubscriptionCollection;
}