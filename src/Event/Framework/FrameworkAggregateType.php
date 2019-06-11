<?php declare(strict_types=1);

namespace Comquer\Event\Framework;

use Comquer\DomainIntegration\Event\AggregateType;
use FatCode\Enum;

/**
 * @method static COMMAND()
 * @method static QUERY()
 * @method static EVENT_LISTENER()
 */
class FrameworkAggregateType extends Enum implements AggregateType
{
    public const COMMAND = 'command';

    public const QUERY = 'query';

    public const EVENT_LISTENER = 'event listener';

    public function __toString(): string
    {
        return $this->getValue();
    }
}