<?php declare(strict_types=1);

namespace Comquer\TestVendor\Event\Store;

use Comquer\Event\EventCollection;
use Comquer\TestVendor\Event\Fixture\EventFixture;
use Comquer\TestVendor\Event\Fixture\EventFixtureCollection;

final class EventStoreBuilder
{
    private $fixtures;

    public function __construct(EventFixtureCollection $fixtures = null)
    {
        $this->fixtures = $fixtures ?: new EventFixtureCollection();
    }

    public function __invoke() : EventStore
    {
        $events = new EventCollection();

        foreach ($this->fixtures as $fixture) {
            $events->addMany($fixture());
        }

        return new EventStore($events);
    }

    public function addFixture(EventFixture $fixture) : self
    {
        $this->fixtures->add($fixture);

        return $this;
    }
}