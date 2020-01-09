<?php declare(strict_types=1);

namespace Comquer\Test\WriteModel\Command;

use Comquer\WriteModel\Command\CommandHandler;
use Comquer\WriteModel\Command\CommandHandlerContainer;
use Comquer\ReadModel\Event\EventStore;
use Comquer\Test\ContainerFactory;
use Comquer\TestVendor\Event\EventDispatcher;
use Comquer\TestVendor\Football\EndGame\EndGameHandler;
use Comquer\TestVendor\Football\GameRepository;
use Comquer\TestVendor\Football\StartGame\StartGameHandler;
use InvalidArgumentException;
use Psr\Container\ContainerInterface;

class CommandHandlerContainerFactory implements ContainerFactory
{
    public function __invoke(EventStore $eventStore) : CommandHandlerContainer
    {
        $container = new class($eventStore) implements ContainerInterface
        {
            private $eventStore;

            public function __construct(EventStore $eventStore)
            {
                $this->eventStore = $eventStore;
            }

            public function get($id) : CommandHandler
            {
                switch ($id) {
                    case StartGameHandler::class:
                        return new StartGameHandler(
                            new GameRepository($this->eventStore),
                            new EventDispatcher($this->eventStore)
                        );
                    case EndGameHandler::class:
                        return new EndGameHandler(
                            new GameRepository($this->eventStore),
                            new EventDispatcher($this->eventStore)
                        );
                    default:
                        throw new InvalidArgumentException("Handler `$id` not found");
                }
            }

            public function has($id) : bool
            {
                return in_array($id, [
                    StartGameHandler::class,
                    EndGameHandler::class,
                ]);
            }
        };

        return new CommandHandlerContainer($container);
    }
}
