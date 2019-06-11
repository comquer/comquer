<?php declare(strict_types=1);

namespace Comquer\Event\Queue;

use Comquer\DomainIntegration\Event\Event;

class EventQueueItem implements \Comquer\DomainIntegration\Event\Queue\EventQueueItem
{
    /** @var Event */
    private $event;

    /** @var string */
    private $listenerName;

    public function __construct(Event $event, string $listenerName)
    {
        $this->event = $event;
        $this->listenerName = $listenerName;
    }

    public function getEvent() : Event
    {
        return $this->event;
    }

    public function getListenerName() : string
    {
        return $this->listenerName;
    }

    public function serialize() : array
    {
        $serializedEventQueueItem = $this->event->serialize();
        $serializedEventQueueItem['listenerName'] = $this->listenerName;

        return $serializedEventQueueItem;
    }
}
