<?php declare(strict_types=1);

namespace Comquer\Event;

use RuntimeException;

class EventSubscriptionProviderException extends RuntimeException
{
    public static function unexpectedSubscriptionImplementation(string $className) : self
    {
        $subscription = Subscription::class;
        return new self("Provided `$subscription` implementation `$className` is not handled");
    }
}