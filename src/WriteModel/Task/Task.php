<?php declare(strict_types=1);

namespace Comquer\WriteModel\Task;

use Comquer\ReadModel\Event\Event;
use Comquer\ReadModel\Serialization\Deserializable;
use Comquer\ReadModel\Serialization\Serializable;

abstract class Task implements Serializable, Deserializable
{
    abstract public function __invoke(Event $event) : void;
}