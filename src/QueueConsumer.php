<?php declare(strict_types=1);

namespace CQRS;

interface QueueConsumer
{
    public function consumeQueue(Queue $queue);
}