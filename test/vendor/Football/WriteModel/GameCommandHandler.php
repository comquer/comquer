<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\WriteModel;

use Comquer\TestVendor\Football\ReadModel\GameRepository;
use Comquer\WriteModel\Command\CommandHandler;
use Comquer\WriteModel\Event\EventDispatcher;

abstract class GameCommandHandler extends CommandHandler
{
    protected GameRepository $gameRepository;

    public function __construct(GameRepository $gameRepository, EventDispatcher $eventDispatcher)
    {
        $this->gameRepository = $gameRepository;
        parent::__construct($eventDispatcher);
    }
}