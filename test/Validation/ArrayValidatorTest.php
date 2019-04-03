<?php declare(strict_types=1);

namespace ComquerTest\Validation;

use Comquer\Validation\ArrayMissingRequiredKeysException;
use Comquer\Validation\ArrayValidator;
use PHPUnit\Framework\TestCase;

class ArrayValidatorTest extends TestCase
{
    /** @test */
    public function throws_exception_for_single_key_missing()
    {
        $invalidArray = [
            'this key' => 'exists',
            'this key also' => 'exists',
        ];

        $expectedException = ArrayMissingRequiredKeysException::singleKeyMissing('missing key');
        $this->expectException(get_class($expectedException));
        $this->expectExceptionMessage($expectedException->getMessage());

        ArrayValidator::validateSingleKeyExists('missing key', $invalidArray);
    }

    /** @test */
    public function throws_exception_for_multiple_keys_missing()
    {
        $invalidArray = [
            'this key' => 'exists',
            'this key also' => 'exists',
        ];

        $missingKeys = ['missing key', 'another missing key'];

        $expectedException = ArrayMissingRequiredKeysException::multipleKeysMissing($missingKeys);
        $this->expectException(get_class($expectedException));
        $this->expectExceptionMessage($expectedException->getMessage());

        ArrayValidator::validateMultipleKeysExist($missingKeys, $invalidArray); 
    }
}

