<?php declare(strict_types=1);

namespace Comquer\Event;

class AggregateType implements \Comquer\DomainIntegration\AggregateType
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString() : string
    {
        return $this->value;
    }
}
