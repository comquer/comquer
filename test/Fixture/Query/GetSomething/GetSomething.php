<?php declare(strict_types=1);

namespace ComquerTest\Fixture\Query\GetSomething;

class GetSomething
{
    private $somethingId;

    public function __construct(string $somethingId)
    {
        $this->somethingId = $somethingId;
    }

    public function getSomethingId(): string
    {
        return $this->somethingId;
    }
}