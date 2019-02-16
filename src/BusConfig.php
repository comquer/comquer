<?php declare(strict_types=1);

namespace CQRS;

use Collection\Collection;
use Collection\Type;

class BusConfig extends Collection
{
    public static function fromArray(array $config): self
    {
        return new self([], Type::integer()); // @todo: kill the dummy
    }

    public function getHandlerClassName($element): string
    {
        return 'handler class name'; // @todo: kill the dummy
    }
}