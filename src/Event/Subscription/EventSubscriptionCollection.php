<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;
use Comquer\Reflection\ClassNamespace\ClassNamespace;

class EventSubscriptionCollection extends Collection
{
    public function __construct(array $subscriptions = [])
    {
        parent::__construct(
            $subscriptions,
            Type::object(EventSubscription::class),
            new UniqueIndex(function (EventSubscription $subscription) {
                return "{$subscription->getEventClassName()}{$subscription->getListenerClassName()}";
            })
        );
    }
    public function filterByEventClassName(ClassNamespace $eventClassName): self
    {
        $filteredSubscriptions = new self();
        foreach ($this as $subscription) {
            if ($subscription->getEventClassName()->equals($eventClassName) === true) {
                $filteredSubscriptions->add($subscription);
            }
        }
        return $filteredSubscriptions;
    }
    public function append(EventSubscriptionCollection $collection): void
    {
        foreach ($collection as $element) {
            $this->add($element);
        }
    }
}