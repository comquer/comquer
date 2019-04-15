<?php declare(strict_types=1);

namespace Comquer\Event;

interface EventDispatcher
{
    public function dispatch(Event $event): void;
}