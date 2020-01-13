<?php declare(strict_types=1);

namespace Comquer\ReadModel\Query\Configuration;

use Comquer\Reflection\ClassName\ClassName;

class QueryConfigurationEntry
{
    private ClassName $query;

    private ClassName $queryHandler;

    public function __construct(ClassName $query, ClassName $queryHandler)
    {
        $this->query = $query;
        $this->queryHandler = $queryHandler;
    }

    public function getQuery() : ClassName
    {
        return $this->query;
    }

    public function getQueryHandler() : ClassName
    {
        return $this->queryHandler;
    }
}