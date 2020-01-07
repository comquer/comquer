<?php declare(strict_types=1);

namespace Comquer\Command\Configuration;

final class CommandConfigurationEntry
{
    private string $command;

    private string $commandHandler;

    public function __construct(string $command, string $commandHandler)
    {
        $this->command = $command;
        $this->commandHandler = $commandHandler;
    }

    public function getCommand() : string
    {
        return $this->command;
    }

    public function getCommandHandler() : string
    {
        return $this->commandHandler;
    }
}