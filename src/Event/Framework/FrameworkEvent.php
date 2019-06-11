<?php declare(strict_types=1);

namespace Comquer\Event\Framework;

use Comquer\DomainIntegration\Event\Event;
use DateTimeImmutable;

abstract class FrameworkEvent implements Event
{
    /** @var DateTimeImmutable */
    private $occurredOn;

    public function __construct(DateTimeImmutable $occurredOn)
    {
        $this->occurredOn = $occurredOn;
    }

    public function getOccurredOn() : DateTimeImmutable
    {
        return $this->occurredOn;
    }
}