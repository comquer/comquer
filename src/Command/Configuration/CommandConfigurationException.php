<?php declare(strict_types=1);

namespace Comquer\Command\Configuration;

use Comquer\Command\Command;
use RuntimeException;

class CommandConfigurationException extends RuntimeException
{
    public static function handlerNotFound(Command $command) : self
    {
        return new self("Handler for `$command` was not found");
    }
}