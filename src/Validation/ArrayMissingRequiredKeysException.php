<?php declare(strict_types=1);

namespace Comquer\Validation;

use RuntimeException;

class ArrayMissingRequiredKeysException extends RuntimeException
{
    private $missingKeys;

    public function __construct(string $message, array $missingKeys)
    {
        parent::__construct($message);
        $this->missingKeys = $missingKeys;
    }

    public static function singleKeyMissing(string $missingKey): self
    {
        return new self("Required key is missing: $missingKey", [$missingKey]);
    }

    public static function multipleKeysMissing(array $missingKeys): self
    {
        $readableMissingKeys = implode (", ", $missingKeys);
        return new self("Required keys are missing: $readableMissingKeys", $missingKeys);
    }

    public function getMissingKeys(): array
    {
        return $this->missingKeys;
    }
}