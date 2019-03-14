<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\Event\Store\DeserializableEvent;
use Comquer\Event\Store\SerializableEvent;
use DateTimeImmutable;

abstract class Event implements SerializableEvent, DeserializableEvent
{
    private $occurredOn;

    abstract public static function getName(): string;

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