<?php declare(strict_types=1);

namespace Comquer\WriteModel\Command;

use Comquer\ReadModel\Query\QueryHandler;
use Psr\Container\ContainerInterface;

final class QueryHandlerContainer
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(string $class) : QueryHandler
    {
        return $this->container->get($class);
    }
}