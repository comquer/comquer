<?php declare(strict_types=1);

namespace Comquer\Http\ReadModel;

use Comquer\Http\Method;
use Comquer\Http\Request;

class GetRequest implements Request
{
    public function getMethod() : Method
    {
        return Method::get();
    }
}