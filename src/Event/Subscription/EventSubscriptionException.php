<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use RuntimeException;

class EventSubscriptionException extends RuntimeException
{
    public static function unexpectedSubscriptionImplementation(string $className) : self
    {
        $subscription = Subscription::class;
        return new self("Provided `$subscription` implementation `$className` is not handled");
    }

    public static function missingKeyFromArrayConfig(string $key) : self
    {
        return new self("Array config is missing a required key: `$key`");
    }

    public static function invalidValueUnderKey(string $key) : self
    {
        return new self("Value of `$key` must be an array");
    }
}