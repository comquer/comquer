<?php declare(strict_types=1);

namespace Comquer\ReadModel\Serialization;

interface Serializable
{
    public function serialize() : array;
}