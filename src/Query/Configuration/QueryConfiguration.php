<?php declare(strict_types=1);

namespace Comquer\Query\Configuration;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;
use Comquer\Query\Query;

final class QueryConfiguration extends Collection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(
            $elements,
            Type::object(QueryConfigurationEntry::class),
            new UniqueIndex(function (QueryConfigurationEntry $entry) {
                return $entry->getQuery();
            })
        );
    }

    public function getQueryHandlerClassForQuery(Query $query) : string
    {
        if ($this->contains((string) $query) === true) {
            /** @var QueryConfigurationEntry $entry */
            $entry = $this->get((string) $query);
            return $entry->getQueryHandler();
        }

        throw QueryConfigurationException::handlerNotFound($query);
    }
}
