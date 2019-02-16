<?php declare(strict_types=1);

namespace CommandQueryEvent;

interface QueueConsumer
{
    public function consumeQueue(Queue $queue);
}