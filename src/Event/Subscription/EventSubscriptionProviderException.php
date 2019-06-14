<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use RuntimeException;

class EventSubscriptionProviderException extends RuntimeException
{
    public static function unexpectedSubscriptionImplementation(string $className) : self
    {
        $subscription = Subscription::class;
        return new self("Provided `$subscription` implementation `$className` is not handled");
    }

    public static function missingEventNamesKeyFromArrayConfig() : self
    {
        return self::missingKeyFromArrayConfig('eventNames');
    }

    public static function missingAggregateTypesKeyFromArrayConfig() : self
    {
        return self::missingKeyFromArrayConfig('aggregateTypes');
    }

    public static function invalidValueOfEventNames() : self
    {
        return self::invalidValueUnderKey('eventNames');
    }

    public static function invalidValueOfAggregateTypes() : self
    {
        return self::invalidValueUnderKey('aggregateType');
    }

    private static function missingKeyFromArrayConfig(string $key) : self
    {
        return new self("Array config is missing a required key: `$key`");
    }

    private static function invalidValueUnderKey(string $key) : self
    {
        return new self("Value of `$key` must be an array");
    }
}