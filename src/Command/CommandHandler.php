<?php declare(strict_types=1);

namespace Comquer\Command;

use Comquer\Event\EventDispatcher;

abstract class CommandHandler
{
    protected EventDispatcher $eventDispatcher;

    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
}
