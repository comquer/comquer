<?php declare(strict_types=1);

namespace Comquer\Command;

use Comquer\Event\EventDispatcher;

abstract class CommandHandler
{
    protected $eventDispatcher;

    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    abstract public function __invoke(Command $command) : void;
}