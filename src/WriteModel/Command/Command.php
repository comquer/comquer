<?php declare(strict_types=1);

namespace Comquer\WriteModel\Command;

abstract class Command
{
    public function __toString() : string
    {
        return get_class($this);
    }
}