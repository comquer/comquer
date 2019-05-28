<?php declare(strict_types=1);

namespace ComquerTest\Fixture\Event;

class UserCreated extends TestEvent
{
    public static function getName() : string
    {
        return 'user created';
    }
}