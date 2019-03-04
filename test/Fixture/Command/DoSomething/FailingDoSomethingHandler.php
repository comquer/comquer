<?php declare(strict_types=1);

namespace CQRSTest\Fixture\Command\DoSomething;

use RuntimeException;

class FailingDoSomethingHandler
{
    public function handle(DoSomething $command): string
    {
        throw new RuntimeException('Twisted ankle');
    }
}