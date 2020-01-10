<?php declare(strict_types=1);

namespace Comquer\ReadModel\Http;

final class Parameter
{
    private string $name;

    private string $value;

    public function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getValue() : string
    {
        return $this->value;
    }
}