<?php declare(strict_types=1);

namespace ComquerTest\Event\Fixture\Events;

use Comquer\Event\Event;

class DogDied extends DogEvent
{
    /** @var string */
    private const EVENT_NAME = 'dog died';

    /** @var string */
    private $dogName;

    public function __construct(string $dogName, \DateTimeImmutable $occurredOn = null)
    {
        $this->dogName = $dogName;
        parent::__construct($occurredOn);
    }

    public static function deserialize(array $event): Event
    {
        return new self(
            $event['dog_name'],
            $event['occurred_on']
        );
    }
    public static function getName(): string
    {
        return self::EVENT_NAME;
    }
    public function serialize(): array
    {
        return [
            'event_name' => self::EVENT_NAME,
            'dog_name' => $this->dogName,
        ];
    }
}