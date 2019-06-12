<?php declare(strict_types=1);

namespace Comquer\Command;

use Comquer\DomainIntegration\Command\Command;
use Comquer\DomainIntegration\Event\EventDispatcher;
use Comquer\Event\AggregateId;
use Comquer\Event\Framework\Command\CommandHandlingFailed;
use Comquer\Event\Framework\Command\CommandHandlingSucceeded;
use Comquer\Exception\FrameworkException;
use Comquer\HandlerProvider;
use Throwable;

class CommandBus
{
    /** @var RegisteredCommands */
    private $registeredCommands;

    /** @var HandlerProvider */
    private $handlerProvider;

    /** @var EventDispatcher */
    private $eventDispatcher;

    public function __construct(RegisteredCommands $registeredCommands, HandlerProvider $handlerProvider, EventDispatcher $eventDispatcher)
    {
        $this->registeredCommands = $registeredCommands;
        $this->handlerProvider = $handlerProvider;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param Command $command
     * @throws Throwable
     */
    public function handle($command) : void
    {
        $this->registeredCommands->mustContain($command);

        $commandHandler = $this->handlerProvider->get(
            $this->registeredCommands->getHandlerClassName($command)
        );

        try {
            $commandHandler->handle($command);
        } catch (Throwable $exception) {
            $this->eventDispatcher->dispatch(
                new CommandHandlingFailed(
                    FrameworkException::fromThrowable($exception),
                    $command::getName(),
                    new AggregateId('') // @todo figure out what the id is
                )
            );
            throw $exception;
        }

        $this->eventDispatcher->dispatch(
            new CommandHandlingSucceeded(
                $command::getName(),
                new AggregateId('') // @todo figure out what the id is
            )
        );
    }
}