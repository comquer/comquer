<?php declare(strict_types=1);

namespace Comquer\Http\Request;

final class Method
{
    private string $method;

    private function __construct(string $method)
    {
        $this->method = $method;
    }

    public static function post() : self
    {
        return new self('POST');
    }

    public static function get() : self
    {
        return new self('GET');
    }

    public function __toString() : string
    {
        return $this->method;
    }
}