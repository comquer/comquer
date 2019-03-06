<?php declare(strict_types=1);

namespace CQRS\Event;

use CQRS\Event\Store\DeserializableEvent;
use CQRS\Event\Store\SerializableEvent;
use DateTimeImmutable;

abstract class Event implements SerializableEvent, DeserializableEvent
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

    abstract public function __toString(): string;
}