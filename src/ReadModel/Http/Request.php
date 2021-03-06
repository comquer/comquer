<?php declare(strict_types=1);

namespace Comquer\ReadModel\Http;

class Request
{
    private string $route;

    private ParameterCollection $parameters;

    public function __construct(string $route, ParameterCollection $parameters = null)
    {
        $this->route = $route;
        $this->parameters = $parameters ?? new ParameterCollection();
    }

    public function getRoute() : string
    {
        return $this->route;
    }

    public function getParameterValue(string $parameterName)
    {
        return $this->parameters->get($parameterName)->getValue();
    }
}