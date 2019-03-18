<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

class EventSubscription
{
    private $eventClassName;

    private $listenerClassName;

    public function __construct(string $eventClassName, string $listenerClassName)
    {
        $this->eventClassName = $eventClassName;
        $this->listenerClassName = $listenerClassName;
    }

    public function getEventClassName(): string
    {
        return $this->eventClassName;
    }

    public function getListenerClassName(): string
    {
        return $this->listenerClassName;
    }
}