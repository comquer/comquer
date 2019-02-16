<?php declare(strict_types=1);

namespace CommandQueryEvent;

interface Queue
{
    public function push($element);

    public function getNext();

    public function isEmpty(): bool;
}