<?php declare(strict_types=1);

namespace Comquer;

use Comquer\DomainIntegration\Command\CommandHandler;

interface HandlerProvider
{
    public function get(string $handlerClassName) : CommandHandler;
}