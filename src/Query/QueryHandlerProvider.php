<?php declare(strict_types=1);

namespace Comquer\Query;

use Comquer\Command\QueryHandlerContainer;
use Comquer\Query\Configuration\QueryConfiguration;

final class QueryHandlerProvider
{
    private QueryConfiguration $queryConfiguration;

    private QueryHandlerContainer $queryHandlerContainer;

    public function __construct(QueryConfiguration $queryConfiguration, QueryHandlerContainer $queryHandlerContainer)
    {
        $this->queryConfiguration = $queryConfiguration;
        $this->queryHandlerContainer = $queryHandlerContainer;
    }

    public function __invoke(Query $query) : QueryHandler
    {
        return ($this->queryHandlerContainer)(
            $this->queryConfiguration->getQueryHandlerClassForQuery($query)
        );
    }
}