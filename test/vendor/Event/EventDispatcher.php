<?php declare(strict_types=1);

namespace Comquer\TestVendor\Event;

use Comquer\Event\Event;
use Comquer\Event\EventStore;

class EventDispatcher implements \Comquer\Event\EventDispatcher
{
    private $eventStore;

    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    public function __invoke(Event $event) : void
    {
        $this->eventStore->persist($event);
    }
}