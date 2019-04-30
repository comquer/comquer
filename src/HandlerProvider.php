<?php declare(strict_types=1);

namespace Comquer;

interface HandlerProvider
{
    public function get(string $handlerClassName);
}