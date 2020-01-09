<?php declare(strict_types=1);

namespace Comquer\ReadModel\Http;

class Endpoint
{
    private string $route;

    private RequestHydrator $hydrator;

    public function __construct(string $route, RequestHydrator $hydrator)
    {
        $this->route = $route;
        $this->hydrator = $hydrator;
    }

    public function getRoute() : string
    {
        return $this->route;
    }

    public function getHydrator() : RequestHydrator
    {
        return $this->hydrator;
    }
}