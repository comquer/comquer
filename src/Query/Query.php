<?php declare(strict_types=1);

namespace Comquer\Query;

abstract class Query
{
    public function __toString() : string
    {
        return get_class($this);
    }
}