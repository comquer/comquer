<?php declare(strict_types=1);

namespace Comquer\Query;

use Comquer\HandlerProvider;

class QueryBus
{
    /** @var RegisteredQueries */
    private $registeredQueries;

    /** @var HandlerProvider */
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