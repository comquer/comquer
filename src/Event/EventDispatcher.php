<?php declare(strict_types=1);

namespace CQRS\Event;

use CQRS\Queue\Queue;

class EventDispatcher
{
    private $registeredEvents;

    private $eventRepository;

    private $queue;

    public function __construct(RegisteredEvents $registeredEvents, EventRepository $eventRepository, Queue $queue)
    {
        $this->registeredEvents = $registeredEvents;
        $this->eventRepository = $eventRepository;
        $this->queue = $queue;
    }

    public function dispatch($event): void
    {
        $this->registeredEvents->mustContain($event);
        $this->eventRepository->persist($event);
        $this->queue->push($event);
    }
}