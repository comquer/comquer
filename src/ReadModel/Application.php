<?php declare(strict_types=1);

namespace Comquer\ReadModel;

use Comquer\ReadModel\Http\EndpointCollection;
use Comquer\ReadModel\Query\Configuration\QueryConfiguration;
use Comquer\ReadModel\Query\Configuration\QueryConfigurationEntry;
use Comquer\WriteModel\Http\Endpoint;

class Application
{
    private EndpointCollection $endpoints;

    private QueryConfiguration $queries;

    public function __construct(
        EndpointCollection $endpoints = null,
        QueryConfiguration $queries = null
    ) {
        $this->endpoints = $endpoints ?? new EndpointCollection();
        $this->queries = $queries ?? new QueryConfiguration();
    }

    public function registerEndpoint(Endpoint $endpoint) : void
    {
        $this->endpoints->add($endpoint);
    }

    public function getEndpoints() : EndpointCollection
    {
        return $this->endpoints;
    }

    public function registerQuery(QueryConfigurationEntry $query) : void
    {
        $this->queries->add($query);
    }

    public function getQueries() : QueryConfiguration
    {
        return $this->queries;
    }
}