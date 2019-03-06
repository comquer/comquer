<?php declare(strict_types=1);

namespace CQRS\Event\Store;

interface SerializableEvent
{
    public function serialize(): array;
}
