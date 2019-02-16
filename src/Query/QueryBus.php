<?php declare(strict_types=1);

namespace CQRS\Query;

use CQRS\HandlerProvider;

class QueryBus
{
    private $registeredQueries;

    private $handlerProvider;

    public function __construct(RegisteredQueries $registeredQueries, HandlerProvider $handlerProvider)
    {
        $this->registeredQueries = $registeredQueries;
        $this->handlerProvider = $handlerProvider;
    }

    public function handle($query)
    {
        $this->registeredQueries->mustContain($query);

        $handler = $this->handlerProvider->get(
            $this->registeredQueries->getHandlerClassName($query)
        );

        return $handler->handle($query);
    }
}