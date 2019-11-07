<?php declare(strict_types=1);

namespace Comquer\TestVendor\Event;

use Comquer\Event\Event;

class EventDispatcher implements \Comquer\Event\EventDispatcher
{
    /** EventStor */
    public function __invoke(Event $event) : void
    {

    }
}