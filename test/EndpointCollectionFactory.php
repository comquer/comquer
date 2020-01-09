<?php declare(strict_types=1);

namespace Comquer\Test;

use Comquer\WriteModel\Http\EndpointCollection;

interface EndpointCollectionFactory
{
    public function __invoke() : EndpointCollection;
}