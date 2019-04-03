<?php declare(strict_types=1);

namespace Comquer\Projection;

use Comquer\Validation\ArrayValidator;
use Comquer\Validation\ArrayMissingRequiredKeysException;

class ProjectionValidator
{
    public function validateSerialized(string $projectionName, array $requiredKeys, array $serializedProjection): void
    {
        try {
            (new ArrayValidator())->validateMultipleKeysExist($requiredKeys, $serializedProjection);
        } catch (ArrayMissingRequiredKeysException $exception) {
            throw ProjectionValidatorException::missingRequiredKeysInSerializedProjection($projectionName, $exception->getMissingKeys());
        }
    }
}
