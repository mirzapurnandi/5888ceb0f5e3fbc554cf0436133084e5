<?php

namespace App\Exceptions;

use Exception;

class SurplusException extends Exception
{
    /**
     * The status code to use for the response.
     *
     * @var int
     */
    public $status = 0;

    /**
     * The status code to use for the response.
     *
     * @var int
     */
    public $message = "";

    public function __construct(string $message, int $code = 422)
    {
        $this->status = $code;
        $this->message = $message;
    }
}
