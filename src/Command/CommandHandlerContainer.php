<?php declare(strict_types=1);

namespace Comquer\Command;

use Psr\Container\ContainerInterface;

class CommandHandlerContainer
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(string $className) : CommandHandler
    {
        return $this->container->get($className);
    }
}