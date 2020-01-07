<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football;

use Comquer\Command\CommandHandler;
use Comquer\TestVendor\Event\EventDispatcher;

abstract class GameCommandHandler extends CommandHandler
{
    protected GameRepository $gameRepository;

    public function __construct(GameRepository $gameRepository, EventDispatcher $eventDispatcher)
    {
        $this->gameRepository = $gameRepository;
        parent::__construct($eventDispatcher);
    }
}