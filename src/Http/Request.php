<?php declare(strict_types=1);

namespace Comquer\Http;

interface Request
{
    public function getMethod() : Method;

    public function getRoute() : string;
}