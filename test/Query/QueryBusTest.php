<?php declare(strict_types=1);

namespace ComquerTest\Query;

use Comquer\HandlerProvider;
use Comquer\Query\QueryBus;
use Comquer\Query\RegisteredQueries;
use ComquerTest\Fixture\Command\DoSomething\DoSomethingHandler;
use ComquerTest\Fixture\Query\GetSomething\GetSomething;
use ComquerTest\Fixture\Query\GetSomething\GetSomethingHandler;
use PHPUnit\Framework\TestCase;

class CommandBusTest extends TestCase
{
    /** @test */
    function instantiate()
    {
        $queryBus = new QueryBus(
            new RegisteredQueries(),
            $this->createMock(HandlerProvider::class)
        );

        self::assertInstanceOf(
            QueryBus::class,
            $queryBus
        );
    }

    /** @test */
    function handle()
    {
        $query = new GetSomething('something id');

        $handlerProvider = $this->createMock(HandlerProvider::class);
        $handlerProvider
            ->method('get')
            ->with(GetSomethingHandler::class)
            ->willReturn(new GetSomethingHandler());

        $registeredQueries = RegisteredQueries::fromArray(
            require __DIR__ . '/../Fixture/Query/queries.php'
        );

        $queryBus = new QueryBus(
            $registeredQueries,
            $handlerProvider
        );

        self::assertSame(
            'Something with id something id',
            $queryBus->handle($query)
        );
    }
}