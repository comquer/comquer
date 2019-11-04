<?php declare(strict_types=1);

namespace Comquer;

use Throwable;

interface UserDisplayableException extends Throwable
{
    public function getUserMessage() : string;
}