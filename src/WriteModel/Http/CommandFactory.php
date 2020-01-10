<?php declare(strict_types=1);

namespace Comquer\WriteModel\Http;

use Comquer\ReadModel\Http\Request;
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