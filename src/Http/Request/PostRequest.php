<?php declare(strict_types=1);

namespace Comquer\Http\Request;

class PostRequest implements Request
{
    public function getMethod() : Method
    {
        return Method::post();
    }
}