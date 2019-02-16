<?php declare(strict_types=1);

namespace CQRS\Queue;

interface QueueConsumer
{
    public function consume(Queue $queue);
}