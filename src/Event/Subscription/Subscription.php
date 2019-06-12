<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use Comquer\DomainIntegration\StringValue;

interface Subscription extends StringValue
{
    public function getListenerName() : string;
}