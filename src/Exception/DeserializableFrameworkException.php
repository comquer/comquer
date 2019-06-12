<?php declare(strict_types=1);

namespace Comquer\Exception;

use Comquer\DomainIntegration\Serialization\Deserializable;

interface DeserializableFrameworkException extends Deserializable
{
    public static function deserialize(array $frameworkException) : FrameworkException;
}