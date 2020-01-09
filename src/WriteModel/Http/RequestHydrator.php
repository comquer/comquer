<?php declare(strict_types=1);

namespace Comquer\WriteModel\Http;

use Comquer\ReadModel\Http\Request;
use Comquer\WriteModel\Command\Command;

interface RequestHydrator
{
    public function __invoke(Request $request) : Command;
}