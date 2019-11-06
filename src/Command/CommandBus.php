<?php declare(strict_types=1);

namespace Comquer\Command;

final class CommandBus
{
    private $handlerProvider;

    public function __construct(CommandHandlerProvider $handlerProvider)
    {
        $this->handlerProvider = $handlerProvider;
    }

    public function __invoke(Command $command) : void
    {
        $commandHandler = ($this->handlerProvider)($command);
        $commandHandler($command);
    }
}