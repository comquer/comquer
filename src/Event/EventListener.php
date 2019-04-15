<?php declare(strict_types=1);

namespace Comquer\Event;

interface EventListener
{
    public function processEvent(Event $event): void;
}
