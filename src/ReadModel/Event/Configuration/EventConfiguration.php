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
            Type::object(ClassName::class),
            new UniqueIndex(function (ClassName $event) {
                return (string) $event;
            })
        );
    }

    public function getEventClassByName(string $eventName) : ClassName
    {
        /** @var ClassName $configurationEntry */
        foreach ($this as $configurationEntry) {
            $serializedEntry = (string) $configurationEntry;
            if ($serializedEntry::getEventName() === $eventName) {
                return $configurationEntry;
            }
        }

        throw EventConfigurationException::eventNotFoundByName($eventName);
    }
}