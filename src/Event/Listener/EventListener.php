<?php declare(strict_types=1);

namespace Comquer\Event\Listener;

use Comquer\Event\Event;

interface EventListener
{
    public function processEvent(Event $event): void;
}