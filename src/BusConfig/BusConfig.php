<?php declare(strict_types=1);

namespace Comquer\BusConfig;

use Comquer\Collection\Collection;
use Comquer\Collection\NotFoundException;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;

class BusConfig extends Collection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(
            $elements,
            Type::object(ConfigElement::class),
            new UniqueIndex(function(ConfigElement $configElement) {
               return $configElement->getKey();
            })
        );
    }

    public static function fromArray(array $configArray): self
    {
        $config = new static();

        foreach ($configArray as $key => $value) {
            $config->add(
                new ConfigElement($key, $value)
            );
        }

        return $config;
    }

    public function getHandlerClassName($object): string
    {
        return $this->get(get_class($object))->getValue();
    }

    public function mustContain($object): void
    {
        try {
            $this->getHandlerClassName($object);
        } catch (NotFoundException $exception) {
            throw BusConfigException::classNotRegistered(get_class($object));
        }
    }
}