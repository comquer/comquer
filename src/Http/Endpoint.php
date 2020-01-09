<?php declare(strict_types=1);

namespace Comquer\Http;

use Comquer\Application\Model;

interface Endpoint
{
    public function getRoute() : string;

    public function getModel() : Model;
}