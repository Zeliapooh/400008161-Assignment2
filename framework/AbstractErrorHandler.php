<?php

namespace COMP3385;

abstract class AbstractErrorHandler
{
    protected $errorLevel;
    public function __construct($errorLevel)
    {
        $this->errorLevel = $errorLevel;
        set_error_handler([$this, 'handleError'], $this->errorLevel);
        set_exception_handler([$this, 'handleException']);
    }
    abstract public function handleError($errno, $errstr, $errfile, $errline);
    abstract public function handleException($e);
    public function __destruct()
    {
        restore_error_handler();
    }
}

