<?php declare(strict_types=1);

namespace CQRS\Bus;

class ConfigElement
{
    private $key;

    private $value;

    public function __construct(string $key, string $value)
    {
        self::validateClassName($key);
        $this->key = $key;

        self::validateClassName($value);
        $this->value = $value;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private static function validateClassName(string $className): void
    {
        if (class_exists($className) === false) {
            throw ConfigElementException::classDoesNotExist($className);
        }
    }
}