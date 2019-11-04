<?php declare(strict_types=1);

namespace ComquerTest\Fixture\Event;

use Comquer\Event\Event;
use Comquer\Event\EventListener;

class UpdateUserProjection implements EventListener
{
    public function __invoke(Event $event) : void
    {
        // Update the projection...
    }

    public static function getName() : string
    {
        return 'update user projection';
    }
}