<?php declare(strict_types=1);

namespace CQRS;

use Exception;
use RuntimeException;

class BusException extends RuntimeException
{
    public static function handlingFailed(string $handledClassName, Exception $parentException): self
    {
        return new static(
            "Handling of $handledClassName failed with message: {$parentException->getMessage()}"
        );
    }
}
