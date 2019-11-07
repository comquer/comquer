<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\StartGame;

use Comquer\Command\CommandHandler;

final class StartGameHandler extends CommandHandler
{
    public function __invoke(StartGame $command) : void
    {
        // Check if game already exists
    }
}