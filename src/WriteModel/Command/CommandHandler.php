<?php declare(strict_types=1);

namespace Comquer\WriteModel\Command;

use Comquer\WriteModel\Event\EventDispatcher;

abstract class CommandHandler
{
    protected EventDispatcher $eventDispatcher;

    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
}
