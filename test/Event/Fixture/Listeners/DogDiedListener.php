<?php declare(strict_types=1);

namespace ComquerTest\Event\Fixture\Listeners;

use Comquer\Event\Event;
use Comquer\Event\Listener\EventListener;

class DogDiedListener implements EventListener
{
    public function processEvent(Event $event): void
    {
        // Be happy. The dog is dead.
    }
}