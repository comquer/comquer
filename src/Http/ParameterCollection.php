<?php declare(strict_types=1);

namespace Comquer\Http;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;

final class ParameterCollection extends Collection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(
            $elements,
            Type::object(Parameter::class),
            new UniqueIndex(function (Parameter $parameter) {
                return $parameter->getName();
            })
        );
    }
}