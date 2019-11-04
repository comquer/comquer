<?php declare(strict_types=1);

namespace ComquerTest\Fixture\Event;

use Comquer\Event\AggregateType;

class ItemRemoved extends TestEvent
{
    public static function getName() : string
    {
        return 'item removed';
    }

    public function getAggregateType() : \Comquer\Event\AggregateType
    {
        return new AggregateType('shopping list');
    }
}