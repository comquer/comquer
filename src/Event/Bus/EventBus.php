<?php declare(strict_types=1);

namespace Comquer\Event\Bus;

use Comquer\BusException;
use Comquer\HandlerProvider;
use Exception;

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
        $this->registeredEvents->mustContain($event);

        $handler = $this->handlerProvider->get(
            $this->registeredEvents->getHandlerClassName($event)
        );

        try {
            return $handler->handle($event);
        } catch (Exception $exception) {
            throw BusException::handlingFailed(get_class($event), $exception);
        }
    }
}