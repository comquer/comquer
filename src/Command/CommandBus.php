<?php declare(strict_types=1);

namespace CommandQueryEvent\Command;

use CommandQueryEvent\HandlerProvider;

class CommandBus
{
    private $registeredCommands;

    private $handlerProvider;

    public function __construct(RegisteredCommands $registeredCommands, HandlerProvider $handlerProvider)
    {
        $this->registeredCommands = $registeredCommands;
        $this->handlerProvider = $handlerProvider;
    }

    public function handle($command): void
    {
        if ($this->registeredCommands->contains($command) === false) {
            //
        }

        $handler = $this->handlerProvider->get(
            $this->registeredCommands->getHandlerClassName($command)
        );

        $handler->handle($command);
    }
}