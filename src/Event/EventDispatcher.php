<?php declare(strict_types=1);

namespace CQRS\Event;

use CQRS\Queue;

class EventDispatcher
{
    private $registeredEvents;

    private $queue;

    public function __construct(RegisteredEvents $registeredEvents, Queue $queue)
    {
        $this->registeredEvents = $registeredEvents;
        $this->queue = $queue;
    }

    public function dispatch($event)
    {
        if ($this->registeredEvents->contains($event) === false) {
            //
        }

        return $this->queue->push($event);
    }
}