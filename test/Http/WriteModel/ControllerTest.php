<?php declare(strict_types=1);

namespace Comquer\Test\Http\WriteModel;

use Comquer\Http\WriteModel\CommandFactory;
use Comquer\Http\WriteModel\Controller;
use PHPUnit\Framework\TestCase;
use function Comquer\TestVendor\Football\bootstrapApplication;

class ControllerTest extends TestCase
{
    /** @test */
    function handle_post_request()
    {
        $application = bootstrapApplication();

        $controller = new Controller(
            new CommandFactory($application->getWriteModelEndpoints()),
            $application->getCommandBus()
        );
    }
}