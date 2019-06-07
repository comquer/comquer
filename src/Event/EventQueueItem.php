<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\DomainIntegration\Event\Event;

class EventQueueItem implements \Comquer\DomainIntegration\Event\EventQueueItem
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

    public static function deserialize(array $serialized) : self
    {
        return;
    }

    public function serialize() : array
    {
        $serializedEvent = $this->event->serialize();
        $serializedEvent['listenerName'] = $this->listenerName;

        return $serializedEvent;
    }
}
