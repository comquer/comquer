<?php declare(strict_types=1);

namespace Comquer\ReadModel\Application;

use Comquer\ReadModel\Http\EndpointCollection;
use Comquer\WriteModel\Http\Endpoint;

class Application
{
    private EndpointCollection $endpoints;

    public function __construct(EndpointCollection $endpoints = null)
    {
        $this->endpoints = $endpoints ?? new EndpointCollection();
    }

    public function registerEndpoint(Endpoint $endpoint) : void
    {
        $this->endpoints->add($endpoint);
    }

    public function getEndpoints(): EndpointCollection
    {
        return $this->endpoints;
    }
}