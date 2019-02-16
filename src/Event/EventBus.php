<?php declare(strict_types=1);

namespace CQRS\Event;

use CQRS\HandlerProvider;

class EventBus
{
    private $registeredEvents;

    private $handlerProvider;

    public function __construct(RegisteredEvents $registeredEvents, HandlerProvider $handlerProvider)
    {
        $this->registeredEvents = $registeredEvents;
        $this->handlerProvider = $handlerProvider;
    }

    public function handle($event)
    {
        if ($this->registeredEvents->contains($event) === false) {
            throw BusException::classNotRegistered(get_class($event));
        }

        $handler = $this->handlerProvider->get(
            $this->registeredEvents->getHandlerClassName($event)
        );

        return $handler->handle($event);
    }
}