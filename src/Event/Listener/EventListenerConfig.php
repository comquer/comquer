<?php declare(strict_types=1);

namespace Comquer\Event\Listener;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;

class EventListenerConfig extends Collection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(
            $elements,
            Type::object(EventListenerConfigElement::class),
            new UniqueIndex(function (EventListenerConfigElement $configElement) {
                return "{$configElement->getListenerName()}{$configElement->getListenerClassName()}";
            })
        );
    }

    public static function fromArray(array $config) : self
    {
        $eventListenerConfig = new self();

        foreach ($config as $listenerName => $listenerClassName) {
            $eventListenerConfig->add(
                new EventListenerConfigElement($listenerName, $listenerClassName)
            );
        }

        return $eventListenerConfig;
    }

    public function getListenerClassByName(string $listenerName) : string
    {
        /** @var EventListenerConfigElement $configElement */
        foreach ($this as $configElement) {
            if ($configElement->getListenerName() === $listenerName) {
                return $configElement->getListenerClassName();
            }
        }

        throw EventListenerConfigException::listenerNotFoundByName($listenerName);
    }
}
