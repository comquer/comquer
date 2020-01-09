<?php declare(strict_types=1);

namespace Comquer\WriteModel\Command\Configuration;

use Comquer\WriteModel\Command\Command;
use RuntimeException;

final class CommandConfigurationException extends RuntimeException
{
    public static function handlerNotFound(Command $command) : self
    {
        return new self("Handler for `$command` was not found");
    }
}