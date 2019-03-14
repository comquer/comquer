<?php declare(strict_types=1);

namespace Comquer\Event\Store;

interface SerializableEvent
{
    public function serialize(): array;
}
