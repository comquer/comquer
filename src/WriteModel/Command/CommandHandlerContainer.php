<?php declare(strict_types=1);

namespace Comquer\WriteModel\Command;

use Comquer\Reflection\ClassName\ClassName;
use Psr\Container\ContainerInterface;

final class CommandHandlerContainer
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(ClassName $className) : CommandHandler
    {
        return $this->container->get((string) $className);
    }
}