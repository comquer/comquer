<?php declare(strict_types=1);

namespace Comquer\Command;

use Comquer\HandlerProvider;

class CommandBus
{
    private $registeredCommands;

    private $handlerProvider;

    public function __construct(RegisteredCommands $registeredCommands, HandlerProvider $handlerProvider)
    {
        $this->registeredCommands = $registeredCommands;
        $this->handlerProvider = $handlerProvider;
    }

    public function handle($command) : void
    {
        $this->registeredCommands->mustContain($command);

        $handler = $this->handlerProvider->get(
            $this->registeredCommands->getHandlerClassName($command)
        );

        $handler->handle($command);
    }
}