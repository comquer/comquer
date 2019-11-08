<?php declare(strict_types=1);

namespace Comquer\Test;

use Comquer\Command\CommandHandlerContainer;
use Comquer\Command\Configuration\CommandConfiguration;
use Comquer\Command\Configuration\CommandConfigurationEntry;
use Comquer\Event\Event;
use Comquer\Test\Command\CommandHandlerContainerFactory;
use Comquer\TestVendor\Event\Fixture\EventFixture;
use Comquer\TestVendor\Event\Store\EventStore;
use Comquer\TestVendor\Football\EndGame\EndGame;
use Comquer\TestVendor\Football\EndGame\EndGameHandler;
use Comquer\TestVendor\Football\StartGame\StartGame;
use Comquer\TestVendor\Football\StartGame\StartGameHandler;
use PHPUnit\Framework\TestCase;

abstract class ComquerTest extends TestCase
{
    /** @var EventStore */
    protected $eventStore;

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