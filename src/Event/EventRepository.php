<?php declare(strict_types=1);

namespace CQRS\Event;

interface EventRepository
{
    public function persist($event);
}
