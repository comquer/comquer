<?php declare(strict_types=1);

namespace ComquerTest\Fixture\Event;

use Comquer\Event\AggregateType;

class ItemAdded extends TestEvent
{
    public static function getName() : string
    {
        return 'item added';
    }

    public function getAggregateType() : \Comquer\DomainIntegration\Event\AggregateType
    {
        return new AggregateType('shopping list');
    }
}