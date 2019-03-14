<?php declare(strict_types=1);

namespace Comquer\Command;

use Comquer\BusException;
use Comquer\HandlerProvider;
use Exception;

class CommandBus
{
    private $registeredCommands;

    private $handlerProvider;

    public function __construct(RegisteredCommands $registeredCommands, HandlerProvider $handlerProvider)
    {
        $this->registeredCommands = $registeredCommands;
        $this->handlerProvider = $handlerProvider;
    }

    public function handle($command)
    {
        $this->registeredCommands->mustContain($command);

        $handler = $this->handlerProvider->get(
            $this->registeredCommands->getHandlerClassName($command)
        );

        try {
            return $handler->handle($command);
        } catch (Exception $exception) {
            throw BusException::handlingFailed(get_class($command), $exception);
        }
    }
}