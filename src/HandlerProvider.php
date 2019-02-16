<?php declare(strict_types=1);

namespace CQRS;

interface HandlerProvider
{
    public function get(string $handlerClassName);
}

