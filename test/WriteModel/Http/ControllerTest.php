<?php declare(strict_types=1);

namespace Comquer\Test\WriteModel\Http;

use Comquer\ReadModel\Http\WriteModel\CommandFactory;
use Comquer\WriteModel\Http\Controller;
use PHPUnit\Framework\TestCase;

use function Comquer\TestVendor\Football\WriteModel\bootstrap;

class ControllerTest extends TestCase
{
    /** @test */
    function handle_request()
    {
        $application = bootstrap();

        $controller = new Controller(
            new CommandFactory($application->getEndpoints()),
            $application->getCommandBus()
        );
    }
}