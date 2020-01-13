<?php declare(strict_types=1);

namespace Comquer;

/** @deprecated */
final class Model
{
    private string $model;

    private function __construct(string $model)
    {
        $this->model = $model;
    }

    public static function read() : self
    {
        return new self('READ');
    }

    public static function write() : self
    {
        return new self('WRITE');
    }

    public function __toString() : string
    {
        return $this->model;
    }

    public function isRead() : bool
    {
        return (string) $this === (string) Model::read();
    }

    public function isWrite() : bool
    {
        return (string) $this === (string) Model::write();
    }
}