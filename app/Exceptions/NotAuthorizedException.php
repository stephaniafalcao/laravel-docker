<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class NotAuthorizedException extends Exception
{
    private function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function create():self
    {
        return new static("Não Autorizado");
    }
}
