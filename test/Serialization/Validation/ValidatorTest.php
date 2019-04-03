<?php declare(strict_types=1);

namespace ComquerTest\Serialization\Validation;

use Comquer\Serialization\Validation\Validator;
use Comquer\Serialization\Validation\ValidationException;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    /** @test */
    public function throws_exception_for_multiple_keys_missing()
    {
        $serializedEntity = [
            'this key' => 'exists',
            'this key also' => 'exists',
        ];

        $missingKeys = ['missing key', 'another missing key'];

        $expectedException = ValidationException::missingRequiredKeysInSerializedEntity('entity name', $missingKeys);
        $this->expectException(get_class($expectedException));
        $this->expectExceptionMessage($expectedException->getMessage());

        Validator::validateSerialized('entity name', $missingKeys, $serializedEntity);
    }
}
