<?php declare(strict_types=1);

namespace Comquer\Projection;

use Comquer\NamedResource;
use Comquer\Serialization\Deserializable;
use Comquer\Serialization\Serializable;

interface Projection extends Serializable, Deserializable, NamedResource
{
    public function getId(): ProjectionId;
}