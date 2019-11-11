<?php declare(strict_types=1);

namespace Comquer\Command;

use Comquer\Query\QueryHandler;
use Psr\Container\ContainerInterface;

final class QueryHandlerContainer
{
    /** @var ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(string $class) : QueryHandler
    {
        return $this->container->get($class);
    }
}