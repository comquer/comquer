<?php declare(strict_types=1);

namespace Comquer\Event\Listener;

use Comquer\DomainIntegration\Event\EventListener;
use Psr\Container\ContainerInterface;

class EventListenerProvider
{
    /** @var ContainerInterface */
    private $container;

    /** @var EventListenerConfig */
    private $eventListenerConfig;

    public function __construct(ContainerInterface $container, EventListenerConfig $eventListenerConfig)
    {
        $this->container = $container;
        $this->eventListenerConfig = $eventListenerConfig;
    }

    public function getByName(string $eventListenerName) : EventListener
    {
        $listenerClassName = $this->eventListenerConfig->getListenerClassByName($eventListenerName);
        return $this->container->get($listenerClassName);
    }
}
