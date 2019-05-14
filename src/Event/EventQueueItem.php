<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\DomainIntegration\Event\Event;
use Comquer\DomainIntegration\Event\EventId;

class EventQueueItem implements \Comquer\DomainIntegration\Event\EventQueueItem
{
    /** @var Event */
    private $event;

    /** @var EventId */
    private $eventId;

    /** @var string */
    private $listenerName;

    public function __construct(Event $event, EventId $eventId, string $listenerName)
    {
        $this->event = $event;
        $this->eventId = $eventId;
        $this->listenerName = $listenerName;
    }

    public function getEvent() : Event
    {
        return $this->event;
    }

    public function getEventId() : EventId
    {
        return $this->eventId;
    }

    public function getListenerName() : string
    {
        return $this->listenerName;
    }
}
