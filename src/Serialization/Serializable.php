<?php declare(strict_types=1);

namespace Comquer\Serialization;

interface Serializable
{
    public function serialize() : array;
}