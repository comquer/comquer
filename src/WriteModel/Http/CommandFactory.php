<?php declare(strict_types=1);

namespace Comquer\ReadModel\Http\WriteModel;

use Comquer\WriteModel\Http\Endpoint;
use Comquer\WriteModel\Http\EndpointCollection;
use Comquer\WriteModel\Command\Command;

class CommandFactory
{
    private EndpointCollection $endpoints;

    public function __construct(EndpointCollection $endpoints)
    {
        $this->endpoints = $endpoints;
    }

    public function createFromRequest(Request $request) : Command
    {
        /** @var Endpoint $endpoint */
        $endpoint = $this->endpoints->get($request->getRoute());

        $requestHydrator = $endpoint->getHydrator();

        return $requestHydrator($request);
    }
}