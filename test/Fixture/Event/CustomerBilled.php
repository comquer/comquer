<?php declare(strict_types=1);

namespace ComquerTest\Fixture\Event;

use Comquer\Event\AggregateType;

class CustomerBilled extends TestEvent
{
    public static function getName() : string
    {
        return 'customer billed';
    }

    public function getAggregateType() :  \Comquer\DomainIntegration\Event\AggregateType
    {
        return new AggregateType('customer');
    }
}