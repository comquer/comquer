<?php declare(strict_types=1);

namespace CommandQueryEvent;

interface HandlerProvider
{
    public function get(string $handlerClassName);
}

