<?php declare(strict_types=1);

namespace ComquerTest\Fixture\Command\DoSomethingElse;

class DoSomethingElse
{
    private $somethingElseId;

    public function __construct(string $somethingElseId)
    {
        $this->somethingElseId = $somethingElseId;
    }

    public function getSomethingElseId(): string
    {
        return $this->somethingElseId;
    }
}