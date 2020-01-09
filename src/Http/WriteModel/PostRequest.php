<?php declare(strict_types=1);

namespace Comquer\Http\WriteModel;

use Comquer\Http\Method;
use Comquer\Http\Request;

class PostRequest extends Request
{
    public function getMethod() : Method
    {
        return Method::post();
    }
}