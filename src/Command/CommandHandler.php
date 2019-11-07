<?php declare(strict_types=1);

namespace Comquer\Command;

interface CommandHandler
{
    public function handle($command) : void;
}