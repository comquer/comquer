<?php declare(strict_types=1);

namespace Comquer\TestVendor\Event\Fixture;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;

final class EventFixtureCollection extends Collection
{
    public function __construct(array $fixtures = [])
    {
        parent::__construct($fixtures, Type::object(EventFixture::class));
    }
}