<?php declare(strict_types=1);

namespace ComquerTest\Event\Fixture\Events;

use Comquer\Event\Event;

class CatDied extends CatEvent
{
    /** @var string */
    private const EVENT_NAME = 'cat died';

    /** @var string */
    private $catName;

    public function __construct(string $catName, \DateTimeImmutable $occurredOn = null)
    {
        $this->catName = $catName;
        parent::__construct($occurredOn);
    }
    public static function deserialize(array $event): Event
    {
        return new self(
            $event['cat_name'],
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
            'cat_name' => $this->catName,
        ];
    }
}