<?php declare(strict_types=1);

namespace Comquer\Test\WriteModel\Http;

use Comquer\ReadModel\Http\Request;
use Comquer\TestVendor\Football\WriteModel\Bootstrap;
use Comquer\WriteModel\Http\Controller;
use Comquer\WriteModel\Http\Response;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    /** @test */
    function handle_request()
    {
        $container = (new Bootstrap())();
        $controller = $container->get(Controller::class);

        $response = $controller(new Request('start-game'));

        self::assertInstanceOf(Response::class, $response);
    }
}