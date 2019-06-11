<?php declare(strict_types=1);

namespace Comquer\Event\Framework\Command;

use Comquer\DomainIntegration\Event\AggregateType;
use Comquer\Event\Framework\FrameworkAggregateType;
use Comquer\Event\Framework\FrameworkEvent;
use DateTimeImmutable;

abstract class CommandEvent extends FrameworkEvent
{
    /** @var Command */
    protected $command;

    public function __construct(Command $command, DateTimeImmutable $occurredOn)
    {
        $this->command = $command;
        parent::__construct($occurredOn);
    }

    public function getAggregateType() : AggregateType
    {
        return FrameworkAggregateType::COMMAND();
    }
}