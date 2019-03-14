<?php declare(strict_types=1);

namespace ComquerTest\BusConfig;

use Comquer\BusConfig\BusConfigException;
use Comquer\Command\RegisteredCommands;
use ComquerTest\Fixture\Command\DoSomething\DoSomething;
use ComquerTest\Fixture\Command\DoSomething\DoSomethingHandler;
use ComquerTest\Fixture\Command\DoSomethingElse\DoSomethingElse;
use PHPUnit\Framework\TestCase;

class BusConfigTest extends TestCase
{
    /** @test */
    function mustContain_throws_exception_if_doesnt()
    {
        $commandConfig = RegisteredCommands::fromArray([
            DoSomething::class => DoSomethingHandler::class
        ]);

        $command = new DoSomethingElse('something else id');
        $exception = BusConfigException::classNotRegistered(get_class($command));

        $this->expectException(get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());

        $commandConfig->mustContain($command);
    }
}