<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class IncException extends Exception
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        $message = sprintf("increment %s error", $message);

        parent::__construct($message, $code, $previous);
    }
}