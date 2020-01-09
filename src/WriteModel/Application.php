<?php declare(strict_types=1);

namespace Comquer\WriteModel;

use Comquer\WriteModel\Command\Configuration\CommandConfiguration;
use Comquer\WriteModel\Command\Configuration\CommandConfigurationEntry;
use Comquer\WriteModel\Http\Endpoint;
use Comquer\WriteModel\Http\EndpointCollection;

class Application
{
    private EndpointCollection $endpoints;

    private CommandConfiguration $commands;

    public function __construct(
        EndpointCollection $endpoints = null,
        CommandConfiguration $commands = null
    ) {
        $this->endpoints = $endpoints ?? new EndpointCollection();
        $this->commands = $commands ?? new CommandConfiguration();
    }

    public function registerEndpoint(Endpoint $endpoint) : void
    {
        $this->endpoints->add($endpoint);
    }

    public function getEndpoints() : EndpointCollection
    {
        return $this->endpoints;
    }

    public function registerCommand(CommandConfigurationEntry $command) : void
    {
        $this->commands->add($command);
    }

    public function getCommands() : CommandConfiguration
    {
        return $this->commands;
    }
}