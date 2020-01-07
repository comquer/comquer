<?php declare(strict_types=1);

namespace Comquer\Query\Configuration;

class QueryConfigurationEntry
{
    private string $query;

    private string $queryHandler;

    public function __construct(string $query, string $queryHandler)
    {
        $this->query = $query;
        $this->queryHandler = $queryHandler;
    }

    public function getQuery() : string
    {
        return $this->query;
    }

    public function getQueryHandler() : string
    {
        return $this->queryHandler;
    }
}