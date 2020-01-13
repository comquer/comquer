<?php declare(strict_types=1);

namespace Comquer\Test;

use Comquer\TestVendor\Event\Store\EventStore as InMemoryEventStore;
use Comquer\TestVendor\Football\WriteModel\Bootstrap;
use Comquer\WriteModel\Event\EventStore;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface as Container;

abstract class ComquerTest extends TestCase
{
    protected Container $container;

    public function setUp() : void
    {
        $this->container = (new Bootstrap())();
        $this->container->set(EventStore::class, new InMemoryEventStore());
        parent::setUp();
    }
}