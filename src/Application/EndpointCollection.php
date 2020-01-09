<?php declare(strict_types=1);

namespace Comquer\Application;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;
use Comquer\Http\Endpoint;

class EndpointCollection extends Collection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(
            $elements,
            Type::object(Endpoint::class),
            new UniqueIndex(function (Endpoint $endpoint) {
                return $endpoint->getRoute();
            })
        );
    }
}