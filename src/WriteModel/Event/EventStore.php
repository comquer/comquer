<?php declare(strict_types=1);

namespace Comquer\WriteModel\Event;

use Comquer\ReadModel\Event\Event;

interface EventStore extends \Comquer\ReadModel\Event\EventStore
{
    public function persist(Event $event) : void;
}