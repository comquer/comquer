<?php declare(strict_types=1);

namespace CQRS\Bus;

class BusException extends \RuntimeException
{
    public static function classNotRegistered(string $className): self
    {
        return new self("Class $className is not registered!");
    }
}