<?php declare(strict_types=1);

namespace Comquer\Validation;

class ArrayValidator
{
    public function validateMultipleKeysExist(array $requiredKeys, array $array): void
    {
        $missingKeys = [];

        foreach ($requiredKeys as $key) {
            try {
                self::validateSingleKeyExists($key, $array);
            } catch (ArrayMissingRequiredKeysException $exception) {
                $missingKeys[] = $key;
            }
        }

        if (empty($missingKeys) === false) {
            throw ArrayMissingRequiredKeysException::multipleKeysMissing($missingKeys);
        }
    }

    public function validateSingleKeyExists(string $requiredKey, array $array): void
    {
        if (array_key_exists($requiredKey, $array) === false) {
            throw ArrayMissingRequiredKeysException::singleKeyMissing($requiredKey);
        }
    }
}
