<?php

namespace APIBase\Exceptions;

class HTTPException extends \Exception {
    public function __construct($message, $code) {
        parent::__construct($message, $code);
    }
}