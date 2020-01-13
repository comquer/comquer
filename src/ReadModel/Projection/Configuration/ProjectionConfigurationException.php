<?php declare(strict_types=1);

namespace Comquer\ReadModel\Event\Configuration;

use RuntimeException;

class ProjectionConfigurationException extends RuntimeException
{
    public static function projectionNotFoundByName(string $projectionName) : self
    {
        return new self("Projection `$projectionName` was not found");
    }
}