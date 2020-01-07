<?php declare(strict_types=1);

namespace Comquer\Command;

final class CommandBus
{
    private CommandHandlerProvider $commandHandlerProvider;

    public function __construct(CommandHandlerProvider $handlerProvider)
    {
        $this->commandHandlerProvider = $handlerProvider;
    }

    public function __invoke(Command $command) : void
    {
        $commandHandler = ($this->commandHandlerProvider)($command);
        $commandHandler($command);
    }
}