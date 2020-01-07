<?php declare(strict_types=1);

namespace Comquer\Command;

use Psr\Container\ContainerInterface;

final class CommandHandlerContainer
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(string $class) : CommandHandler
    {
        return $this->container->get($class);
    }
}