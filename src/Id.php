<?php declare(strict_types=1);

namespace Comquer;

class Id implements StringValue
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString() : string
    {
        return $this->value;
    }

    public static function generate() : self
    {
        return new static(uniqid());
    }
}