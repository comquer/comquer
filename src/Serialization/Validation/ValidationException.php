<?php declare(strict_types=1);

namespace Comquer\Serialization\Validation;

use RuntimeException;

final class ValidationException extends RuntimeException
{
    public static function missingRequiredKeysInSerializedEntity(string $entityName, array $missingKeys): self
    {
        $missingKeys = implode(', ', $missingKeys);
        return new self("Serialized entity $entityName is missing required keys: $missingKeys");
    }
}
