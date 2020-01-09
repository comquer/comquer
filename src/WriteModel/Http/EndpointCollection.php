<?php declare(strict_types=1);

namespace Comquer\WriteModel\Http;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;

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