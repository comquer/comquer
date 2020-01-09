<?php declare(strict_types=1);

namespace Comquer\WriteModel\Command;

use Comquer\WriteModel\Command\Configuration\CommandConfiguration;

final class CommandHandlerProvider
{
    private CommandConfiguration $commandConfiguration;

    private CommandHandlerContainer $commandHandlerContainer;

    public function __construct(CommandConfiguration $commandConfiguration, CommandHandlerContainer $commandHandlerContainer)
    {
        $this->commandConfiguration = $commandConfiguration;
        $this->commandHandlerContainer = $commandHandlerContainer;
    }

    public function __invoke(Command $command) : CommandHandler
    {
        return ($this->commandHandlerContainer)(
            $this->commandConfiguration->getCommandHandlerClassForCommand($command)
        );
    }
}