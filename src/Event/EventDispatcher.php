<?php declare(strict_types=1);

namespace CQRS\Event;

interface EventDispatcher
{
    public function dispatch($event): void;
}