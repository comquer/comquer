<?php declare(strict_types=1);

namespace Comquer\Query;

use Comquer\BusException;
use Comquer\HandlerProvider;
use Exception;

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

        try {
            return $handler->handle($query);
        } catch (Exception $exception) {
            throw BusException::handlingFailed(get_class($query), $exception);
        }
    }
}