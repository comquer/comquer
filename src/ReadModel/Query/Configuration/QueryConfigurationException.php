<?php declare(strict_types=1);

namespace Comquer\ReadModel\Query\Configuration;

use Comquer\ReadModel\Query\Query;
use InvalidArgumentException;

final class QueryConfigurationException extends InvalidArgumentException
{
    public static function handlerNotFound(Query $query) : self
    {
        return new self("Handler for `$query` was not found");
    }
}
