<?php declare(strict_types=1);

namespace CQRSTest\Fixture\Command\DoSomethingElse;

class DoSomethingElseHandler
{
    public function handle(DoSomethingElse $command): string
    {
        // Handling command...
        return $command->getSomethingElseId();
    }
}