<?php declare(strict_types=1);

namespace Comquer\Http\WriteModel;

use Comquer\Http\Method;
use Comquer\Http\Request;

class PostRequest implements Request
{
    private string $route;

    public function __construct(string $route)
    {
        $this->route = $route;
    }

    public function getMethod() : Method
    {
        return Method::post();
    }

    public function getRoute() : string
    {
        return $this->route;
    }
}