<?php declare(strict_types=1);

namespace UnicornTest\TestInfrastructure\Event\Store;

use Unicorn\Framework\Event\EventCollection;
use UnicornTest\TestInfrastructure\Event\Store\Fixture\EventStoreFixture;
use UnicornTest\TestInfrastructure\Event\Store\Fixture\EventStoreFixtureCollection;

class EventStoreBuilder
{
    /** @var EventStoreFixtureCollection */
    private $fixtures;

    public function __construct(EventStoreFixtureCollection $fixtures = null)
    {
        $this->fixtures = $fixtures ?: new EventStoreFixtureCollection();
    }

    public function build() : EventStore
    {
        $events = new EventCollection();

        foreach ($this->fixtures as $fixture) {
            $events->addMany($fixture());
        }

        return new EventStore($events);
    }

    public function addFixture(EventStoreFixture $fixture) : self
    {
        $this->fixtures->add($fixture);

        return $this;
    }
}