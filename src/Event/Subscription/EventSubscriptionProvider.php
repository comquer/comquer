<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use Comquer\Event\Event;
use Comquer\Reflection\ClassNamespace\ClassNamespace;

class EventSubscriptionProvider
{
    /** @var EventSubscriptionCollection */
    private $eventSubscriptions;

    public function __construct(EventSubscriptionCollection $eventSubscriptions)
    {
        $this->eventSubscriptions = $eventSubscriptions;
    }

    public function getForEvent(Event $event): EventSubscriptionCollection
    {
        $eventClassName = new ClassNamespace(get_class($event));
        $filteredSubscriptions = $this->eventSubscriptions->filterByEventClassName($eventClassName);
        
        foreach ($eventClassName->getParents() as $parentEventClassName) {
            $filteredSubscriptions->append(
                $this->eventSubscriptions->filterByEventClassName($parentEventClassName)
            );
        }

        return $filteredSubscriptions;
    }
}