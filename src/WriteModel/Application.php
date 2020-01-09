<?php declare(strict_types=1);

namespace Comquer\WriteModel;

use Comquer\WriteModel\Command\CommandBus;
use Comquer\WriteModel\Command\Configuration\CommandConfigurationEntry;
use Comquer\WriteModel\Http\Endpoint;
use Comquer\WriteModel\Http\EndpointCollection;

class Application
{
    private CommandBus $commandBus;

    private EndpointCollection $endpoints;

    public function __construct(CommandBus $commandBus, EndpointCollection $endpoints = null)
    {
        $this->commandBus = $commandBus;
        $this->endpoints = $endpoints ?? new EndpointCollection();
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

    public function getCommandBus() : CommandBus
    {

    }
}