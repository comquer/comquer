<?php declare(strict_types=1);

namespace ComquerTest\Fixture\Event;

class CustomerBilled extends TestEvent
{
    public static function getName() : string
    {
        return 'customer billed';
    }
}