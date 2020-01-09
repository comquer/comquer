<?php declare(strict_types=1);

namespace Comquer\Http\WriteModel;

use Comquer\Command\CommandBus;
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

    public function __invoke(PostRequest $request) : Response
    {
        $command = $this->commandFactory->createFromRequest($request);

        try {
            ($this->commandBus)($command);
        } catch (Throwable $exception) {
            return ErrorResponse::fromException($exception);
        }

        return HttpResponse::forSuccessfulCommand($command);
    }
}