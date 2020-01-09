<?php declare(strict_types=1);

namespace Comquer\Http\WriteModel;

use Comquer\Application\Model;

class Endpoint implements \Comquer\Http\Endpoint
{
    private string $route;

    private Hydrator $hydrator;

    public function __construct(string $route, Hydrator $hydrator)
    {
        $this->route = $route;
        $this->hydrator = $hydrator;
    }

    public function getRoute() : string
    {
        return $this->route;
    }

    public function getHydrator() : Hydrator
    {
        return $this->hydrator;
    }

    public function getModel() : Model
    {
        return Model::write();
    }
}