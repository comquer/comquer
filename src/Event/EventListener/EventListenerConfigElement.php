<?php declare(strict_types=1);

namespace Comquer\Event\EventListener;

use Comquer\Reflection\ClassName\ClassName;

class EventListenerConfigElement
{
    /** @var string */
    private $listenerName;

    /** @var string */
    private $listenerClassName;

    public function __construct(string $listenerName, string $listenerClassName)
    {
        self::validate($listenerName, $listenerClassName);

        $this->listenerName = $listenerName;
        $this->listenerClassName = $listenerClassName;
    }

    private static function validate(string $listenerName, string $listenerClassName) : void
    {
        $listenerReflection = new ClassName($listenerClassName);
        $listenerReflection->mustImplement(EventListener::class);

        if ($listenerClassName::getName() !== $listenerName) {
            throw EventListenerConfigException::nameAndClassNameMismatch($listenerName, $listenerClassName);
        }
    }

    public function getListenerName() : string
    {
        return $this->listenerName;
    }

    public function getListenerClassName() : string
    {
        return $this->listenerClassName;
    }
}
