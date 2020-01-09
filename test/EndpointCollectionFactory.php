<?php declare(strict_types=1);

namespace Comquer\Test;

use Comquer\Application\EndpointCollection;

interface EndpointCollectionFactory
{
    public function __invoke() : EndpointCollection;
}