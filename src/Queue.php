<?php declare(strict_types=1);

namespace CQRS;

interface Queue
{
    public function push($element);

    public function getNext();

    public function isEmpty(): bool;
}