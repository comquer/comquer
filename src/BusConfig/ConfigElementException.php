<?php declare(strict_types=1);

namespace Comquer\BusConfig;

class ConfigElementException extends \RuntimeException
{
    public static function classDoesNotExist(string $className): self
    {
        return new self("$className is not a valid class name!");
    }
}