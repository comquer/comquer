<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\NamedResource;
use Comquer\Serialization\Deserializable;
use Comquer\Event\Store\SerializableEvent;
use DateTimeImmutable;

abstract class Event implements SerializableEvent, Deserializable, NamedResource
{
    private $occurredOn;

    public function __construct(DateTimeImmutable $occurredOn = null)
    {
        $this->occurredOn = $occurredOn ?: new DateTimeImmutable();
    }

    public function getOccurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }

    public function __toString(): string
    {
        return $this::getName();
    }
}