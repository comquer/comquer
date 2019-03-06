<?php declare(strict_types=1);

namespace CQRS\Queue;

interface Queue
{
    public function queueForHandling($element);

    public function pullNextInLine();

    public function isEmpty(): bool;
}