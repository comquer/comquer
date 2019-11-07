<?php declare(strict_types=1);

namespace Comquer\TestVendor\Football\EndGame;

use Comquer\Command\CommandHandler;

final class EndGameHandler extends CommandHandler
{
    public function __invoke(EndGame $command) : void
    {
        // Check if game already exists
    }
}