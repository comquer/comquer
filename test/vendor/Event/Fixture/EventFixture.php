<?php declare(strict_types=1);

namespace Comquer\TestVendor\Event\Fixture;

use Comquer\Event\EventCollection;

interface EventFixture
{
    public function __invoke() : EventCollection;
}