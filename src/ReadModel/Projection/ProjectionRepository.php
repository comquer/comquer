<?php declare(strict_types=1);

namespace Comquer\ReadModel\Projection;

use Comquer\Persistence\Database\DatabaseClient;
use Comquer\ReadModel\Projection\Configuration\ProjectionConfiguration;
use Comquer\Validator\ArrayValidator\ArrayValidator;

class ProjectionRepository
{
    private DatabaseClient $databaseClient;

    private ProjectionConfiguration $projectionConfiguration;

    public function __construct(DatabaseClient $databaseClient, ProjectionConfiguration $projectionConfiguration)
    {
        $this->databaseClient = $databaseClient;
        $this->projectionConfiguration = $projectionConfiguration;
    }

    public function get(string $projectionName, ProjectionId $projectionId) : Projection
    {
        $documents = $this->databaseClient->getByQuery($projectionName, [
            'projectionId' => (string) $projectionId,
        ]);

        $document = array_shift($documents);
        ArrayValidator::validateSingleKeyExists('projectionName', $document);

        $projectionClassName = (string) $this->projectionConfiguration->getProjectionClassByName(
            $document['projectionName']
        );

        return $projectionClassName::deserialize($document);
    }

    public function exists(ProjectionId $projectionId, string $projectionName) : bool
    {
        $documents = $this->databaseClient->getByQuery($projectionName, [
            'projectionId' => (string) $projectionId,
        ]);

        return empty($documents) === false;
    }
}