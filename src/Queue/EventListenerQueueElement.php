<?php declare(strict_types=1);

namespace Comquer\Queue;

use Comquer\Event\Store\EventId;
use Comquer\Reflection\ClassNamespace\ClassNamespace;

class EventListenerQueueElement
{
    /** @var EventId */
    private $eventId;

    /** @var ClassNamespace */
    private $listenerClassName;

    public function __construct(EventId $eventId, ClassNamespace $listenerClassName)
    {
        $this->eventId = $eventId;
        $this->listenerClassName = $listenerClassName;
    }

    public function getEventId(): EventId
    {
        return $this->eventId;
    }

    public function getListenerClassName(): ClassNamespace
    {
        return $this->listenerClassName;
    }
}