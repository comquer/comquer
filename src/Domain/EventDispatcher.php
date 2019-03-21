<?php declare(strict_types=1);

namespace Comquer\Domain;

interface EventDispatcher
{
    public function dispatch(Event $event): void;
}