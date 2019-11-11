<?php declare(strict_types=1);

namespace Comquer\Command;

final class CommandBus
{
    /** @var CommandHandlerProvider */
    private $commandHandlerProvider;

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