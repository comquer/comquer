<?php declare(strict_types=1);

namespace Comquer\Event\Framework;

use Comquer\DomainIntegration\Event\AggregateType;
use FatCode\Enum;

/**
 * @method static COMMAND_HANDLING()
 * @method static QUERY_HANDLING()
 * @method static EVENT_HANDLING()
 */
class FrameworkAggregateType extends Enum implements AggregateType
{
    public const COMMAND_HANDLING = 'command handling';

    public const QUERY_HANDLING = 'query handling';

    public const EVENT_HANDLING = 'event handling';

    public function __toString() : string
    {
        return $this->getValue();
    }
}