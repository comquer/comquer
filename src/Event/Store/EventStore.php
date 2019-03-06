<?php declare(strict_types=1);

namespace CQRS\Event\Store;

interface EventStore
{
    public function registerEvent($event): EventStoreId;
}
