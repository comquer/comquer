<?php declare(strict_types=1);

namespace Comquer\Http\WriteModel;

use Comquer\Application\EndpointCollection;
use Comquer\Command\Command;

class CommandFactory
{
    private EndpointCollection $endpoints;

    public function __construct(EndpointCollection $endpoints)
    {
        $this->endpoints = $endpoints;
    }

    public function createFromRequest(PostRequest $request) : Command
    {
        /** @var Endpoint $endpoint */
        $endpoint = $this->endpoints->get($request->getRoute());

        $requestHydrator = $endpoint->getHydrator();

        return $requestHydrator($request);
    }
}