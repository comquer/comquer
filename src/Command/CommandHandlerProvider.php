<?php declare(strict_types=1);

namespace Comquer\Command;

class CommandHandlerProvider
{
    private $handlerConfig;

    private $handlerContainer;

    public function __invoke(Command $command) : CommandHandler
    {

    }
}