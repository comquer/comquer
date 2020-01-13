<?php declare(strict_types=1);

namespace Comquer\Test;

use Comquer\TestVendor\Football\BootstrapContainer;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface as Container;

abstract class ComquerTest extends TestCase
{
    protected Container $container;

    public function setUp() : void
    {
        $this->container = (new BootstrapContainer())();
        parent::setUp();
    }
}