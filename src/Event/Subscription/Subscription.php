<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

interface Subscription
{
    public function getListenerName() : string;

    public function __toString() : string;
}