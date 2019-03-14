<?php declare(strict_types=1);

namespace Comquer\Queue;

interface Queue
{
    public function push($element);

    public function pullNext();

    public function isEmpty(): bool;
}