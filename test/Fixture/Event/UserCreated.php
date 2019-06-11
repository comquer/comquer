<?php declare(strict_types=1);

namespace ComquerTest\Fixture\Event;

use Comquer\Event\AggregateType;

class UserCreated extends TestEvent
{
    public static function getName() : string
    {
        return 'user created';
    }

    public function getAggregateType() : \Comquer\DomainIntegration\Event\AggregateType
    {
        return new AggregateType('user');
    }
}