<?php declare(strict_types=1);

namespace Comquer\ReadModel\Event\Configuration;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;
use Comquer\Reflection\ClassName\ClassName;

class EventConfiguration extends Collection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(
            $elements,
            Type::object(EventConfigurationEntry::class),
            new UniqueIndex(function (EventConfigurationEntry $configurationEntry) {
                return (string) $configurationEntry->getEvent();
            })
        );
    }

    public function getEventClassByName(string $eventName) : ClassName
    {
        /** @var EventConfigurationEntry $configurationEntry */
        foreach ($this as $configurationEntry) {
            $event = (string) $configurationEntry->getEvent();
            if ($event::getEventName() === $eventName) {
                return $configurationEntry->getEvent();
            }
        }
        throw EventConfigurationException::eventNotFoundByName($eventName);
    }
}