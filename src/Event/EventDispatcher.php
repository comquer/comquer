<?php declare(strict_types=1);

namespace Comquer\Event;

interface EventDispatcher
{
    public function __invoke(Event $event) : void;
}