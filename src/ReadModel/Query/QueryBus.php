<?php declare(strict_types=1);

namespace Comquer\ReadModel\Query;

final class QueryBus
{
    private QueryHandlerProvider $handlerProvider;

    public function __construct(QueryHandlerProvider $handlerProvider)
    {
        $this->handlerProvider = $handlerProvider;
    }

    public function __invoke(Query $query)
    {
        $queryHandler = ($this->handlerProvider)($query);

        return $queryHandler($query);
    }
}