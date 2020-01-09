<?php declare(strict_types=1);

namespace Comquer\Application;

use Comquer\Http\Endpoint;

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

    public function getWriteModelEndpoints() : EndpointCollection
    {
        return $this->endpoints->filter(function (Endpoint $endpoint) {
            return $endpoint->getModel()->isWrite();
        });
    }

    public function getReadModelEndpoints() : EndpointCollection
    {
        return $this->endpoints->filter(function (Endpoint $endpoint) {
            return $endpoint->getModel()->isRead();
        });
    }
}