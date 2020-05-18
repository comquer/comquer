<?php declare(strict_types=1);

namespace Comquer\Test\WriteModel\Http;

use Comquer\ReadModel\Http\Parameter;
use Comquer\ReadModel\Http\ParameterCollection;
use Comquer\ReadModel\Http\Request;
use Comquer\Test\ComquerTest;
use Comquer\TestVendor\Football\ReadModel\GameId;
use Comquer\WriteModel\Http\HttpController;
use Comquer\WriteModel\Http\Response;

class HttpControllerTest extends ComquerTest
{
    /** @test */
    function handle_start_game_request()
    {
        $controller = $this->container->get(HttpController::class);

        $gameId = new Parameter('gameId', (string) GameId::generate());
        $response = $controller(new Request('start-game', new ParameterCollection([$gameId])));

        self::assertInstanceOf(Response::class, $response);
    }

    /** @test */
    function handle_start_and_end_game_requests()
    {
        $controller = $this->container->get(HttpController::class);

        $gameId = new Parameter('gameId', (string) GameId::generate());
        $response = $controller(new Request('start-game', new ParameterCollection([$gameId])));
        self::assertInstanceOf(Response::class, $response);

        $response = $controller(new Request('end-game', new ParameterCollection([$gameId])));
        self::assertInstanceOf(Response::class, $response);
    }
}
