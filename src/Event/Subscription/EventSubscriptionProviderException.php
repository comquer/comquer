<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use RuntimeException;
use Comquer\Event\Subscription\EventSubscriptionArrayConfigKeyName as ConfigKey;

class EventSubscriptionProviderException extends RuntimeException
{
    public static function unexpectedSubscriptionImplementation(string $className) : self
    {
        $subscription = Subscription::class;
        return new self("Provided `$subscription` implementation `$className` is not handled");
    }

    public static function missingEventNamesKeyFromArrayConfig() : self
    {
        return self::missingKeyFromArrayConfig((string) ConfigKey::EVENT_NAMES);
    }

    public static function missingAggregateTypesKeyFromArrayConfig() : self
    {
        return self::missingKeyFromArrayConfig((string) ConfigKey::AGGREGATE_TYPES);
    }

    public static function invalidValueOfEventNames() : self
    {
        return self::invalidValueUnderKey((string) ConfigKey::EVENT_NAMES);
    }

    public static function invalidValueOfAggregateTypes() : self
    {
        return self::invalidValueUnderKey((string) ConfigKey::AGGREGATE_TYPES);
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