<?php declare(strict_types=1);

namespace Comquer\Http;

class HttpRequestException extends \RuntimeException
{
    public static function forUnsupportedMethod(string $method) : self
    {
        return new self("This http method is not supported: $method");
    }
}