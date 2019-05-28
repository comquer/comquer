<?php declare(strict_types=1);

namespace ComquerTest\Fixture\Event;

use Comquer\DomainIntegration\Event\Event;
use Comquer\Event\EventListener;

class NotifyAdminAboutUserCreation implements EventListener
{
    public function __invoke(Event $event) : void
    {
    }

    public static function getName(): string
    {
        return 'notify admin about user creation';
    }
}