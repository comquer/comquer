<?php declare(strict_types=1);

namespace Comquer\Test;

use Comquer\WriteModel\Command\CommandHandlerContainer;
use Comquer\WriteModel\Command\Configuration\CommandConfiguration;
use Comquer\WriteModel\Command\Configuration\CommandConfigurationEntry;
use Comquer\ReadModel\Event\Event;
use Comquer\Test\WriteModel\Command\CommandHandlerContainerFactory;
use Comquer\TestVendor\Event\Fixture\EventFixture;
use Comquer\TestVendor\Event\Store\EventStore;
use Comquer\TestVendor\Football\WriteModel\EndGame\EndGame;
use Comquer\TestVendor\Football\WriteModel\EndGame\EndGameHandler;
use Comquer\TestVendor\Football\WriteModel\StartGame\StartGame;
use Comquer\TestVendor\Football\WriteModel\StartGame\StartGameHandler;
use PHPUnit\Framework\TestCase;

abstract class ComquerTest extends TestCase
{
    protected EventStore $eventStore;

    public function setUp() : void
    {
        $this->eventStore = new EventStore();
        parent::setUp();
    }

    protected function loadFixture(EventFixture $fixture) : self
    {
        /** @var Event $event */
        foreach ($fixture() as $event) {
            $this->eventStore->persist($event);
        }

        return $this;
    }

    protected function buildCommandConfiguration() : CommandConfiguration
    {
        return new CommandConfiguration([
            new CommandConfigurationEntry(StartGame::class, StartGameHandler::class),
            new CommandConfigurationEntry(EndGame::class, EndGameHandler::class),
        ]);
    }

    protected function buildCommandHandlerContainer() : CommandHandlerContainer
    {
        return (new CommandHandlerContainerFactory())($this->eventStore);
    }
}