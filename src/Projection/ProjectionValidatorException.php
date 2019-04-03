<?php declare(strict_types=1);

namespace Comquer\Projection;

use RuntimeException;

class ProjectionValidatorException extends RuntimeException
{
    public static function missingRequiredKeysInSerializedProjection(string $projectionName, array $missingKeys): self
    {
        $missingKeys = implode(", ", $missingKeys);
        return new self("Serialized projection $projectionName is missing required keys: $missingKeys");
    }
}