<?php declare(strict_types=1);

namespace Comquer\WriteModel\Command\Configuration;

use Comquer\Reflection\ClassName\ClassName;

final class CommandConfigurationEntry
{
    private ClassName $command;

    private ClassName $commandHandler;

    public function __construct(ClassName $command, ClassName $commandHandler)
    {
        $this->command = $command;
        $this->commandHandler = $commandHandler;
    }

    public function getCommand() : ClassName
    {
        return $this->command;
    }

    public function getCommandHandler() : ClassName
    {
        return $this->commandHandler;
    }
}