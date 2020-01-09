<?php declare(strict_types=1);

namespace Comquer\ReadModel\Http;

use Comquer\ReadModel\Query\Query;

interface RequestHydrator
{
    public function __invoke(Request $request) : Query;
}