<?php declare(strict_types=1);

namespace Comquer\Test\WriteModel\Http;

use Comquer\ReadModel\Http\Request;
use Comquer\Test\ComquerTest;
use Comquer\WriteModel\Http\Controller;
use Comquer\WriteModel\Http\Response;

class ControllerTest extends ComquerTest
{
    /** @test */
    function handle_request()
    {
        $controller = $this->container->get(Controller::class);
        $response = $controller(new Request('start-game'));

        self::assertInstanceOf(Response::class, $response);
    }
}