<?php declare(strict_types=1);

namespace ComquerTest\Fixture\Query\GetSomething;

class GetSomethingHandler
{
    public function handle(GetSomething $getSomething) : string
    {
        return "Something with id {$getSomething->getSomethingId()}";
    }
}