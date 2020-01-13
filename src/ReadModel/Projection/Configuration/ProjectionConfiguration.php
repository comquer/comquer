<?php declare(strict_types=1);

namespace Comquer\ReadModel\Projection\Configuration;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;
use Comquer\ReadModel\Event\Configuration\ProjectionConfigurationException;
use Comquer\Reflection\ClassName\ClassName;

class ProjectionConfiguration extends Collection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(
            $elements,
            Type::object(ClassName::class),
            new UniqueIndex(function (ClassName $configurationEntry) {
                return (string) $configurationEntry;
            })
        );
    }

    public function getProjectionClassByName(string $projectionName) : ClassName
    {
        /** @var ClassName $configurationEntry */
        foreach ($this as $configurationEntry) {
            $serializedEntry = (string) $configurationEntry;
            if ($serializedEntry::getProjectionName() === $projectionName) {
                return $configurationEntry;
            }
        }

        throw ProjectionConfigurationException::projectionNotFoundByName($projectionName);
    }
}
