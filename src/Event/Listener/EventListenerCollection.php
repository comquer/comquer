<?php declare(strict_types=1);

namespace Comquer\Event\Listener;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;

class EventListenerCollection extends Collection
{
    public function __construct(array $listeners = [])
    {
        parent::__construct(
            $listeners,
            Type::object(EventListener::class)
        );
    }
}