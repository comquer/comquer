<?php declare(strict_types=1);

namespace Comquer\Query;

interface QueryHandler
{
    public function handle($query);
}