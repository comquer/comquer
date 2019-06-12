<?php declare(strict_types=1);

namespace Comquer\Event\Framework\Command;

use Comquer\DomainIntegration\Event\AggregateId;
use Comquer\DomainIntegration\Event\AggregateType;
use Comquer\Event\Framework\FrameworkAggregateType;
use Comquer\Event\Framework\FrameworkEvent;
use DateTimeImmutable;

abstract class CommandHandlingEvent extends FrameworkEvent
{
    /** @var string */
    protected $commandName;

    public function __construct(string $commandName, AggregateId $aggregateId, DateTimeImmutable $occurredOn)
    {
        $this->commandName = $commandName;
        parent::__construct($aggregateId, $occurredOn);
    }

    public function getCommandName() : string
    {
        return $this->commandName;
    }

    public function getAggregateType() : AggregateType
    {
        return FrameworkAggregateType::COMMAND_HANDLING();
    }
}