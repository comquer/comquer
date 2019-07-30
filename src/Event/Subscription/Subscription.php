<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use Comquer\DomainIntegration\Event\Event;
use Comquer\DomainIntegration\StringValue;

abstract class Subscription implements StringValue
{
    /** @var string */
    private $listenerName;

    public function __construct(string $listenerName)
    {
        $this->listenerName = $listenerName;
    }

    public function getListenerName() : string
    {
        return $this->listenerName;
    }

    abstract public function isForEvent(Event $event) : bool;
}