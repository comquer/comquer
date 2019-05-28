<?php declare(strict_types=1);

namespace ComquerTest\Fixture\Event;

class ItemAdded extends TestEvent
{
    public static function getName() : string
    {
        return 'item added';
    }
}