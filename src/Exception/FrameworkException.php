<?php declare(strict_types=1);

namespace Comquer\Exception;

use Comquer\DomainIntegration\Serialization\Serializable;
use RuntimeException;
use Throwable;

class FrameworkException extends RuntimeException implements Serializable, DeserializableFrameworkException
{
    /** @var string */
    private $exceptionClass;

    public function __construct(string $message, int $code, string $exceptionClass)
    {
        $this->exceptionClass = $exceptionClass;
        parent::__construct($message, $code);
    }

    public static function fromThrowable(Throwable $exception) : self
    {
        return new self(
            $exception->getMessage(),
            $exception->getCode(),
            get_class($exception)
        );
    }

    public static function deserialize(array $frameworkException) : self
    {
        return new self(
            $frameworkException['message'],
            $frameworkException['code'],
            $frameworkException['exceptionClass']
        );
    }

    public function serialize() : array
    {
        return [
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
            'exceptionClass' => $this->getExceptionClass()
        ];
    }

    public function getExceptionClass() : string
    {
        return $this->exceptionClass;
    }
}
