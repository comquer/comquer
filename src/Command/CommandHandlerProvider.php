<?php declare(strict_types=1);

namespace Comquer\Command;

use Comquer\Command\Configuration\CommandConfiguration;

final class CommandHandlerProvider
{
    private $commandConfiguration;

    private $commandHandlerContainer;

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