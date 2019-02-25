<?php declare(strict_types=1);

namespace CQRSTest\Fixture\Command\DoSomething;

class DoSomething
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