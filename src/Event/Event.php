<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\NamedResource;
use Comquer\Serialization\Serializable;
use DateTimeImmutable;

interface Event extends Serializable, DeserializableEvent, NamedResource
{
    public function getAggregateId() : AggregateId;

    public function getAggregateType() : AggregateType;

    public function getOccurredOn() : DateTimeImmutable;
}