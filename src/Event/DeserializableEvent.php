<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\Serialization\Deserializable;

interface DeserializableEvent extends Deserializable
{
    public static function deserialize(array $event) : Event;
}