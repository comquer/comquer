<?php declare(strict_types=1);

namespace Comquer\WriteModel\Http;

use Comquer\WriteModel\Command\Command;
use Throwable;

class Response
{
    private int $statusCode;

    private string $message;

    public function __construct(int $statusCode, string $message)
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
    }

    public static function fromException(Throwable $exception) : self
    {
        return new self(500, $exception->getMessage());
    }

    public static function fromCommand(Command $command) : self
    {
        return new self(201, get_class($command));
    }
}
