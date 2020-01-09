<?php declare(strict_types=1);

namespace Comquer\Http;

use Comquer\Command\CommandBus;
use Psr\Http\Message\RequestInterface as HttpRequest;
use Psr\Http\Message\ResponseInterface as HttpResponse;
use Throwable;

/** @deprecated */
class Controller
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(HttpRequest $request) : HttpResponse
    {
        switch ($request->getMethod()) {
            case 'POST':
                return $this->handleWriteRequest($request);
            case 'GET':
                return $this->handleQueryRequest($request);
            default:
                throw HttpRequestException::forUnsupportedMethod($request->getMethod());
        }
    }

    private function handleWriteRequest(HttpRequest $request) : HttpResponse
    {
        $command = $this->commandFactory->createFromRequest($request);

        try {
            ($this->commandBus)($command);
        } catch (Throwable $exception) {
            return ErrorResponse::fromException($exception);
        }

        return HttpResponse::forSuccessfulCommand($command);
    }

    private function handleQueryRequest(HttpRequest $request) : HttpResponse
    {
        $query = $this->queryFactory->createFromRequest($request);

        try {
            $queryResult = ($this->queryBus)($query);
            return HttpResponse::forSuccessfulQuery($query, $queryResult);
        } catch (Throwable $exception) {
            return ErrorResponse::fromException($$exception);
        }
    }
}