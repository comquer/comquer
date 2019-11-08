<?php declare(strict_types=1);

namespace Comquer\Command\Configuration;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;
use Comquer\Command\Command;

final class CommandConfiguration extends Collection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(
            $elements,
            Type::object(CommandConfigurationEntry::class),
            new UniqueIndex(function (CommandConfigurationEntry $entry) {
                return $entry->getCommand();
            })
        );
    }

    public function getCommandHandlerClassForCommand(Command $command) : string
    {
        if ($this->contains((string) $command) === true) {
            /** @var CommandConfigurationEntry $entry */
            $entry = $this->get((string) $command);
            return $entry->getCommandHandler();
        }

        throw CommandConfigurationException::handlerNotFound($command);
    }
}