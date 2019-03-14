<?php declare(strict_types=1);

namespace Comquer\Queue;

interface QueueConsumer
{
    public function consume(Queue $queue);
}