<?php declare(strict_types=1);

namespace Comquer\WriteModel\Http;

use Comquer\ReadModel\Http\Request;
use Comquer\ReadModel\Http\WriteModel\CommandFactory;
use Comquer\WriteModel\Command\CommandBus;
use Throwable;

class Controller
{
    private CommandFactory $commandFactory;

    private CommandBus $commandBus;

    public function __construct(CommandFactory $commandFactory, CommandBus $commandBus)
    {
        $this->commandFactory = $commandFactory;
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request) : Response
    {
        $command = $this->commandFactory->createFromRequest($request);

        try {
            ($this->commandBus)($command);
        } catch (Throwable $exception) {
            return Response::fromException($exception);
        }

        return Response::fromCommand($command);
    }
}