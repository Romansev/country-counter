<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class CountryNotFoundException extends Exception
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        $message = sprintf("Country %s not found", $message);

        parent::__construct($message, $code, $previous);
    }
}