<?php declare(strict_types=1);

namespace Comquer\Event\Subscription;

use Comquer\DomainIntegration\StringValue;
use FatCode\Enum;

/**
 * @method static EVENT_NAMES()
 * @method static AGGREGATE_TYPES()
 */
class EventSubscriptionType extends Enum implements StringValue
{
    public const EVENT_NAMES = 'event names';

    public const AGGREGATE_TYPES = 'aggregate types';

    public function __toString() : string
    {
        return $this->getValue();
    }
}