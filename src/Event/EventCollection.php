<?php declare(strict_types=1);

namespace Comquer\Event;

use Comquer\Collection\Collection;
use Comquer\Collection\Type;
use Comquer\Collection\UniqueIndex;

class EventCollection extends Collection
{
    public function __construct(array $events = [])
    {
        parent::__construct(
            $events,
            Type::object(Event::class),
            new UniqueIndex(function (Event $event) {
                return (string) $event->getAggregateId();
            })
        );
    }

    public function containsOfType(string $type) : bool
    {
        /** @var Event $event */
        foreach ($this as $event) {
            if ($event instanceof $type) {
                return true;
            }
        }
        return false;
    }

    public function getMostRecentOfType(string $type) : Event
    {
        /** @var Event $event */
        $sorted = $this->sortDescendingByOccurrence();
        foreach ($sorted as $event) {
            if ($event instanceof $type) {
                return $event;
            }
        }

        throw EventCollectionException::eventOfTypeNotFound($type);
    }

    public function sortDescendingByOccurrence() : self
    {
        $sortedEvents = $this->getElements();

        usort($sortedEvents, function (Event $event, Event $anotherEvent) {
            if ($event->getOccurredOn()->getTimestamp() > $anotherEvent->getOccurredOn()->getTimestamp()) {
                return -1;
            }

            if ($event->getOccurredOn()->getTimestamp() < $anotherEvent->getOccurredOn()->getTimestamp()) {
                return 1;
            }

            return 0;
        });

        return new self($sortedEvents);
    }

    public function sortAscendingByOccurrence() : self
    {
        return new self(array_reverse($this->sortDescendingByOccurrence()->getElements()));
    }

    public function getMostRecent() : Event
    {
        if ($this->isEmpty() === true) {
            throw EventCollectionException::empty();
        }

        $eventsSerialized = $this->sortAscendingByOccurrence()->getElements();
        return end($eventsSerialized);
    }

    public function getLeastRecent() : Event
    {
        if ($this->isEmpty() === true) {
            throw EventCollectionException::empty();
        }

        $eventsSerialized = $this->sortDescendingByOccurrence()->getElements();
        return end($eventsSerialized);
    }
}