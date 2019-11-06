<?php declare(strict_types=1);

namespace Comquer\Command;

use Comquer\Command\Configuration\CommandConfiguration;

class CommandHandlerProvider
{
    private $commandConfiguration;

    private $commandHandlerContainer;

    public function __construct(CommandConfiguration $commandConfig, CommandHandlerContainer $commandHandlerContainer)
    {
        $this->commandConfiguration = $commandConfig;
        $this->commandHandlerContainer = $commandHandlerContainer;
    }

    public function __invoke(Command $command) : CommandHandler
    {
    }
}