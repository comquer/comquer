<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use Comquer\Reflection\ClassNamespace\ClassNamespace;

class EventSubscription
{
    private $eventClassName;

    private $listenerClassName;

    public function __construct(ClassNamespace $eventClassName, ClassNamespace $listenerClassName)
    {
        $this->eventClassName = $eventClassName;
        $this->listenerClassName = $listenerClassName;
    }

    public static function fromNamespaces(string $eventClassNamespace, string $listenerClassNamespace): self
    {
        return new self(
            new ClassNamespace($eventClassNamespace),
            new ClassNamespace($listenerClassNamespace)
        );
    }

    public function getEventClassName(): ClassNamespace
    {
        return $this->eventClassName;
    }

    public function getListenerClassName(): ClassNamespace
    {
        return $this->listenerClassName;
    }
}