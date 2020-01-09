<?php declare(strict_types=1);

namespace Comquer\Http\Request;

interface Request
{
    public function getMethod() : Method;
}