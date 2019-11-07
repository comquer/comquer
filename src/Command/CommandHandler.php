<?php declare(strict_types=1);

namespace Comquer\Command;

abstract class CommandHandler
{
    abstract public function __invoke(Command $command) : void;
}