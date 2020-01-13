<?php declare(strict_types=1);

namespace Comquer\ReadModel\Query\Configuration;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;
use Comquer\ReadModel\Query\Query;
use Comquer\Reflection\ClassName\ClassName;

final class QueryConfiguration extends Collection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(
            $elements,
            Type::object(QueryConfigurationEntry::class),
            new UniqueIndex(function (QueryConfigurationEntry $entry) {
                return (string) $entry->getQuery();
            })
        );
    }

    public function getQueryHandlerClassForQuery(Query $query) : ClassName
    {
        if ($this->contains((string) $query) === true) {
            /** @var QueryConfigurationEntry $entry */
            $entry = $this->get((string) $query);
            return $entry->getQueryHandler();
        }

        throw QueryConfigurationException::handlerNotFound($query);
    }
}
