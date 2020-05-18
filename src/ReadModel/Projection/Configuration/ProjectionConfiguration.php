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
            Type::object(ProjectionConfigurationEntry::class),
            new UniqueIndex(function (ProjectionConfigurationEntry $configurationEntry) {
                return (string) $configurationEntry->getProjection();
            })
        );
    }

    public function getProjectionClassByName(string $projectionName) : ClassName
    {
        /** @var ProjectionConfigurationEntry $configurationEntry */
        foreach ($this as $configurationEntry) {
            $serializedEntry = (string) $configurationEntry->getProjection();
            if ($serializedEntry::getProjectionName() === $projectionName) {
                return $configurationEntry;
            }
        }

        throw ProjectionConfigurationException::projectionNotFoundByName($projectionName);
    }
}
