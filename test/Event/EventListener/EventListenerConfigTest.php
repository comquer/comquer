<?php declare(strict_types=1);

namespace ComquerTest\Event\EventListener;

use Comquer\Event\EventListener\EventListenerConfig;
use Comquer\Event\EventListener\EventListenerConfigElement;
use ComquerTest\Fixture\Event\NotifyAdminAboutUserCreation;
use ComquerTest\Fixture\Event\UpdateShoppingListProjection;
use ComquerTest\Fixture\Event\UpdateUserProjection;
use PHPUnit\Framework\TestCase;

class EventListenerConfigTest extends TestCase
{
    /** @test */
    function create_from_array()
    {
        $arrayConfig = [
            NotifyAdminAboutUserCreation::getName() => NotifyAdminAboutUserCreation::class,
            UpdateShoppingListProjection::getName() => UpdateShoppingListProjection::class,
            UpdateUserProjection::getName() => UpdateUserProjection::class,
        ];

        $listenerConfig = EventListenerConfig::fromArray($arrayConfig);

        self::assertInstanceOf(EventListenerConfig::class, $listenerConfig);
    }

    function get_listener_class_by_name()
    {
        $listenerConfig = new EventListenerConfig([
            new EventListenerConfigElement(NotifyAdminAboutUserCreation::getName(), NotifyAdminAboutUserCreation::class),
            new EventListenerConfigElement(UpdateShoppingListProjection::getName(), UpdateShoppingListProjection::class)
        ]);

        self::assertSame(
            UpdateShoppingListProjection::class,
            $listenerConfig->getListenerClassByName(UpdateShoppingListProjection::getName())
        );
    }
}