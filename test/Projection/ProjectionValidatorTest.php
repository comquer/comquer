<?php declare(strict_types=1);

namespace ComquerTest\Projection;

use Comquer\Projection\ProjectionValidator;
use Comquer\Projection\ProjectionValidatorException;
use PHPUnit\Framework\TestCase;

class ProjectionValidatorTest extends TestCase
{
    /** @test */
    public function throws_exception_for_multiple_key_missing()
    {
        $serializedProjection = [
            'this key' => 'exists',
            'this key also' => 'exists',
        ];

        $missingKeys = ['missing key', 'another missing key'];

        $expectedException = ProjectionValidatorException::missingRequiredKeysInSerializedProjection('projection name', $missingKeys);
        $this->expectException(get_class($expectedException));
        $this->expectExceptionMessage($expectedException->getMessage());

        ProjectionValidator::validateSerialized('projection name', $missingKeys, $serializedProjection);
    }
}