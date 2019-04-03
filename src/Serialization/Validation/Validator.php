<?php declare(strict_types=1);

namespace Comquer\Serialization\Validation;

use Comquer\Validation\ArrayValidator;
use Comquer\Validation\ArrayMissingRequiredKeysException;

class Validator
{
    public static function validateSerialized(string $entityName, array $requiredKeys, array $serializedEntity): void
    {
        try {
            ArrayValidator::validateMultipleKeysExist($requiredKeys, $serializedEntity);
        } catch (ArrayMissingRequiredKeysException $exception) {
            throw ValidationException::missingRequiredKeysInSerializedEntity($entityName, $exception->getMissingKeys());
        }
    }
}
