<?php declare(strict_types=1);

namespace Comquer\ReadModel\Event;

use Comquer\Persistence\Database\DatabaseClient;
use Comquer\ReadModel\Event\Configuration\EventConfiguration;
use Comquer\Validator\ArrayValidator\ArrayValidator;

class EventStore
{
    protected const COLLECTION = 'events';

    protected DatabaseClient $client;

    private EventConfiguration $configuration;

    public function __construct(DatabaseClient $client, EventConfiguration $configuration)
    {
        $this->client = $client;
        $this->configuration = $configuration;
    }

    public function getByQuery(array $query) : EventCollection
    {
        return $this->deserialize(
            $this->client->getByQuery(self::COLLECTION, $query)
        );
    }

    public function getByAggregateId(AggregateId $aggregateId) : EventCollection
    {
        return $this->getByQuery([
            'aggregateId' => (string) $aggregateId,
        ]);
    }

    public function getByAggregateType(AggregateType $aggregateType) : EventCollection
    {
        return $this->getByQuery([
            'aggregateType' => (string) $aggregateType,
        ]);
    }

    private function deserialize(array $documents) : EventCollection
    {
        $events = new EventCollection();

        foreach ($documents as $document) {
            ArrayValidator::validateSingleKeyExists('eventName', $document);
            $eventClassName = (string) $this->configuration->getEventClassByName($document['eventName']);
            $events->add($eventClassName::deserialize($document));
        }

        return $events;
    }
}