<?php declare(strict_types=1);

namespace Comquer\Event\Publisher;

use Comquer\Event\Store\EventId;
use Comquer\Event\Subscription\EventSubscription;
use Comquer\Event\Subscription\EventSubscriptionProvider;
use Comquer\Event\Worker\JobDispatcher;

class EventPublisher
{
    /** @var EventSubscriptionProvider */
    private $subscriptionProvider;

    /** @var JobDispatcher */
    private $jobDispatcher;

    public function __construct(EventSubscriptionProvider $subscriptionProvider, JobDispatcher $jobDispatcher)
    {
        $this->subscriptionProvider = $subscriptionProvider;
        $this->jobDispatcher = $jobDispatcher;
    }

    public function publishEvent(EventId $eventId)
    {
        /** @var EventSubscription $subscription */
        foreach ($this->subscriptionProvider->getForEvent($eventId) as $subscription) {
            $this->jobDispatcher->processSubscription($subscription);
        }
    }
}
