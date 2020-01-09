<?php declare(strict_types=1);

namespace Comquer\Http\WriteModel;

use Comquer\Command\Command;

interface Hydrator
{
    public function __invoke(PostRequest $request) : Command;
}