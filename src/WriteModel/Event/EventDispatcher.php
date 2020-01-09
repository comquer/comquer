<?php declare(strict_types=1);

namespace Comquer\WriteModel\Event;

use Comquer\ReadModel\Event\Event;

interface EventDispatcher
{
    public function __invoke(Event $event) : void;
}