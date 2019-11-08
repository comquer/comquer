<?php declare(strict_types=1);

namespace Comquer\Test;

use Comquer\TestVendor\Event\Store\EventStoreBuilder;
use PHPUnit\Framework\TestCase;

abstract class ComquerTest extends TestCase
{
    protected $eventStoreBuilder;

    public function setUp() : void
    {
        $this->eventStoreBuilder = new EventStoreBuilder();
        parent::setUp();
    }
}