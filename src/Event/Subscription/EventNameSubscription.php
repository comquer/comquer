<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use Comquer\Event\Event;

class EventNameSubscription extends Subscription
{
    /** @var string */
    private $eventName;

    public function __construct(string $eventName, string $listenerName)
    {
        $this->eventName = $eventName;
        parent::__construct($listenerName);
    }

    public function getEventName() : string
    {
        return $this->eventName;
    }

    public function __toString() : string
    {
        return "{$this->getEventName()}{$this->getListenerName()}";
    }

    public function isForEvent(Event $event) : bool
    {
        return $this->getEventName() === $event::getName();
    }
}