<?php declare(strict_types=1);

namespace CQRS;

class BusException extends \RuntimeException
{
    public static function classNotRegistered(string $commandClassName): self
    {
        return new self("Class $commandClassName is not registered!");
    }
}