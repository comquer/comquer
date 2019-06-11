<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

class EventSubscription implements Subscription
{
    /** @var string */
    private $eventName;

    /** @var string */
    private $listenerName;

    public function __construct(string $eventName, string $listenerName)
    {
        $this->eventName = $eventName;
        $this->listenerName = $listenerName;
    }

    public function getEventName() : string
    {
        return $this->eventName;
    }

    public function getListenerName() : string
    {
        return $this->listenerName;
    }

    public function __toString(): string
    {
        return "{$this->getEventName()}{$this->getListenerName()}";
    }
}